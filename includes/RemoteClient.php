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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( '\\WPO\\IPS\\Mpdf\\RemoteClient' ) ) :

/**
 * Check core's remote resource policy, then delegate fetching to mPDF.
 */
class RemoteClient implements ClientInterface {

	/**
	 * @var string[] Allowed remote hosts.
	 */
	private array $hosts;

	/**
	 * @var int[] Allowed remote ports.
	 */
	private array $ports;

	/**
	 * @var ClientInterface|null Native mPDF transport.
	 */
	private ?ClientInterface $client = null;

	/**
	 * Initialize the allowed remote hosts and ports.
	 *
	 * @param string[] $hosts Allowed hosts from core.
	 * @param int[]    $ports Allowed ports from core.
	 */
	public function __construct( array $hosts, array $ports ) {
		$this->hosts = $hosts;
		$this->ports = $ports;
	}

	/**
	 * Use the same native transport selection as mPDF.
	 *
	 * @param Mpdf $mpdf Renderer instance providing transport options.
	 * @return void
	 */
	public function set_mpdf( Mpdf $mpdf ): void {
		$logger       = new NullLogger();
		$this->client = function_exists( 'curl_init' )
			? new CurlHttpClient( $mpdf, $logger )
			: new SocketHttpClient( $logger );
	}

	/**
	 * Fetch an allowed resource using mPDF's native options and error handling.
	 *
	 * @param RequestInterface $request Resource request.
	 * @return ResponseInterface
	 * @throws \LogicException When the native transport has not been initialized.
	 */
	public function sendRequest( RequestInterface $request ): ResponseInterface {
		if ( ! wpo_ips_is_allowed_remote_resource( (string) $request->getUri(), $this->hosts, $this->ports ) ) {
			wcpdf_log_error( 'Remote PDF resource host, port or scheme is not allowed.', 'warning', null, 'woocommerce-pdf-ips-mpdf' );
			return ( new Response() )->withStatus( 403 );
		}

		if ( null === $this->client ) {
			throw new \LogicException( 'The PDF resource client has no renderer.' );
		}

		return $this->client->sendRequest( $request );
	}

}

endif; // class_exists
