<?php
namespace WPO\IPS\Mpdf;

use WPO\IPS\Mpdf\Vendor\Mpdf\Container\ContainerInterface;
use WPO\IPS\Mpdf\Vendor\Mpdf\Http\ClientInterface;
use WPO\IPS\Mpdf\Vendor\Mpdf\Mpdf;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( '\\WPO\\IPS\\Mpdf\\ResourceContainer' ) ) :

/**
 * Supply the remote resource client through mPDF's service container.
 */
class ResourceContainer implements ContainerInterface {

	/**
	 * @var RemoteClient Restricted HTTP client.
	 */
	private RemoteClient $client;

	/**
	 * Initialize the resource container.
	 *
	 * @param RemoteClient $client HTTP client.
	 */
	public function __construct( RemoteClient $client ) {
		$this->client = $client;
	}

	/**
	 * Initialize the native transport with the live renderer's options.
	 *
	 * @param Mpdf $mpdf Renderer instance.
	 * @return void
	 */
	public function set_mpdf( Mpdf $mpdf ): void {
		$this->client->set_mpdf( $mpdf );
	}

	/**
	 * Check whether the requested service is supplied.
	 *
	 * @param mixed $id Service identifier, matching mPDF's interface.
	 * @return bool
	 */
	public function has( mixed $id ): bool {
		return 'httpClient' === $id;
	}

	/**
	 * Get the remote resource client.
	 *
	 * @param mixed $id Service identifier, matching mPDF's interface.
	 * @return ClientInterface
	 * @throws \InvalidArgumentException When the service is unavailable.
	 */
	public function get( mixed $id ): ClientInterface {
		if ( ! $this->has( $id ) ) {
			throw new \InvalidArgumentException( 'Unknown mPDF service.' );
		}

		return $this->client;
	}

}

endif; // class_exists
