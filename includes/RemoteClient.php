<?php
namespace WPO\IPS\Mpdf;

use WPO\IPS\Mpdf\Vendor\Mpdf\Http\ClientInterface;
use WPO\IPS\Mpdf\Vendor\Mpdf\Http\CurlHttpClient;
use WPO\IPS\Mpdf\Vendor\Mpdf\Http\SocketHttpClient;
use WPO\IPS\Mpdf\Vendor\Mpdf\Mpdf;
use WPO\IPS\Mpdf\Vendor\Mpdf\PsrHttpMessageShim\Response;
use WPO\IPS\Mpdf\Vendor\Psr\Http\Message\RequestInterface;
use WPO\IPS\Mpdf\Vendor\Psr\Http\Message\ResponseInterface;
use WPO\IPS\Mpdf\Vendor\Psr\Log\NullLogger;
use WPO\IPS\Vendor\Dompdf\Options;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( '\\WPO\\IPS\\Mpdf\\RemoteClient' ) ) :

/**
 * Apply core's remote resource rules before fetching through mPDF.
 */
class RemoteClient implements ClientInterface {

	private Options $options;
	private ClientInterface $client;

	/**
	 * Constructor.
	 *
	 * @param Options $options Remote resource rules configured by core.
	 */
	public function __construct( Options $options ) {
		$this->options = $options;
	}

	/**
	 * Initialize mPDF's native HTTP client with the renderer's options.
	 *
	 * @param Mpdf $mpdf Renderer instance.
	 * @return void
	 */
	public function set_mpdf( Mpdf $mpdf ): void {
		$logger       = new NullLogger();
		$this->client = function_exists( 'curl_init' )
			? new CurlHttpClient( $mpdf, $logger )
			: new SocketHttpClient( $logger );
	}

	/**
	 * Validate the request using core's rules, then let mPDF fetch it.
	 *
	 * @param RequestInterface $request Resource request.
	 * @return ResponseInterface
	 */
	public function sendRequest( RequestInterface $request ): ResponseInterface {
		$url       = (string) $request->getUri();
		$protocol  = strtolower( (string) wp_parse_url( $url, PHP_URL_SCHEME ) ) . '://';
		$protocols = $this->options->getAllowedProtocols();

		if ( ! in_array( $protocol, array( 'http://', 'https://' ), true ) || ! isset( $protocols[ $protocol ] ) ) {
			return ( new Response() )->withStatus( 403 );
		}

		foreach ( $protocols[ $protocol ]['rules'] as $rule ) {
			list( $allowed ) = $rule( $url );

			if ( ! $allowed ) {
				return ( new Response() )->withStatus( 403 );
			}
		}

		return $this->client->sendRequest( $request );
	}

}

endif; // class_exists
