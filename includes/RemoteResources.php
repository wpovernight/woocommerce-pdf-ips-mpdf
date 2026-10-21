<?php

use WPO\IPS\Mpdf\Vendor\Mpdf\Container\ContainerInterface;
use WPO\IPS\Mpdf\Vendor\Mpdf\Http\ClientInterface;
use WPO\IPS\Mpdf\Vendor\Mpdf\MpdfException;
use WPO\IPS\Mpdf\Vendor\Mpdf\PsrHttpMessageShim\Response;
use WPO\IPS\Mpdf\Vendor\Mpdf\PsrHttpMessageShim\Stream;
use WPO\IPS\Mpdf\Vendor\Psr\Http\Message\RequestInterface;
use WPO\IPS\Mpdf\Vendor\Psr\Http\Message\ResponseInterface;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Supply a restricted HTTP client without changing mPDF's local image/font loading.
 */
class WCPDF_mPDF_Resource_Container implements ContainerInterface {

	/** @var ClientInterface Restricted HTTP client supplied to mPDF. */
	private ClientInterface $client;

	/**
	 * Initialize the mPDF service container.
	 *
	 * @param ClientInterface $client Restricted HTTP client.
	 */
	public function __construct( ClientInterface $client ) {
		$this->client = $client;
	}

	/**
	 * Check whether the requested service is provided.
	 *
	 * @param mixed $id Service identifier; kept broad to match mPDF's interface.
	 * @return bool Whether the service exists.
	 */
	public function has( mixed $id ): bool {
		return 'httpClient' === $id;
	}

	/**
	 * Retrieve the restricted HTTP client.
	 *
	 * @param mixed $id Service identifier; kept broad to match mPDF's interface.
	 * @return ClientInterface Restricted HTTP client.
	 * @throws \InvalidArgumentException When the service is not provided.
	 */
	public function get( mixed $id ): ClientInterface {
		if ( ! $this->has( $id ) ) {
			throw new \InvalidArgumentException( 'Unknown mPDF service.' );
		}

		return $this->client;
	}

}

/**
 * Enforce core's host and port policy on every request, including redirects.
 */
class WCPDF_mPDF_Remote_Client implements ClientInterface {

	/** @var string[] Normalized hostnames allowed to serve remote resources. */
	private array $hosts;
	/** @var int[] Ports allowed for remote resources. */
	private array $ports;

	/**
	 * Initialize the allowed hosts and ports.
	 *
	 * @param string[] $hosts Allowed hostnames.
	 * @param int[]    $ports Allowed ports.
	 */
	public function __construct( array $hosts, array $ports ) {
		$this->hosts = array_values( array_unique( array_map( static function ( string $host ): string {
			return rtrim( strtolower( $host ), '.' );
		}, array_filter( $hosts, 'is_string' ) ) ) );
		$this->ports = $ports;
	}

	/**
	 * Fetch a remote resource after checking each redirect destination.
	 *
	 * @param RequestInterface $request Resource request from mPDF.
	 * @return ResponseInterface HTTP response containing the resource body.
	 * @throws MpdfException When the URL is disallowed, fetching fails, or redirects exceed the limit.
	 */
	public function sendRequest( RequestInterface $request ): ResponseInterface {
		$url = (string) $request->getUri();

		// WordPress must not follow redirects before their destination is checked.
		for ( $redirects = 0; $redirects <= 5; $redirects++ ) {
			if ( ! $this->is_allowed( $url ) ) {
				throw new MpdfException( 'Remote PDF resource host, port or scheme is not allowed.' );
			}

			$result = wp_remote_get( $url, array(
				'redirection' => 0,
				'timeout'     => 10,
			) );

			if ( is_wp_error( $result ) ) {
				throw new MpdfException( 'Could not load remote PDF resource: ' . $result->get_error_message() );
			}

			$status   = (int) wp_remote_retrieve_response_code( $result );
			$location = wp_remote_retrieve_header( $result, 'location' );

			if ( in_array( $status, array( 301, 302, 303, 307, 308 ), true ) && $location ) {
				$url = \WP_Http::make_absolute_url( $location, $url );
				continue;
			}

			return ( new Response() )
				->withStatus( $status )
				->withBody( Stream::create( wp_remote_retrieve_body( $result ) ) );
		}

		throw new MpdfException( 'Too many redirects while loading a remote PDF resource.' );
	}

	/**
	 * Check a URL against the allowed HTTP schemes, hosts, and ports.
	 *
	 * @param string $url Absolute resource URL.
	 * @return bool Whether the URL may be requested.
	 */
	private function is_allowed( string $url ): bool {
		$parts = wp_parse_url( $url );
		if ( ! is_array( $parts ) || isset( $parts['user'] ) || isset( $parts['pass'] ) ) {
			return false;
		}

		$scheme = strtolower( $parts['scheme'] ?? '' );
		$host   = rtrim( strtolower( $parts['host'] ?? '' ), '.' );
		$port   = $parts['port'] ?? ( 'https' === $scheme ? 443 : 80 );

		return in_array( $scheme, array( 'http', 'https' ), true )
			&& '' !== $host
			&& in_array( $host, $this->hosts, true )
			&& in_array( $port, $this->ports, true );
	}

}
