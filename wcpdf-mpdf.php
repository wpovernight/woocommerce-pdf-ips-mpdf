<?php
/**
 * Plugin Name: WooCommerce PDF Invoices & Packing Slips + mPDF
 * Plugin URI: http://www.wpovernight.com
 * Description: Uses mPDF instead of dompdf for HTML to PDF conversion
 * Version: 1.0
 * Author: Ewout Fernhout
 * Author URI: http://www.wpovernight.com
 * License: GPLv2 or later
 * License URI: http://www.opensource.org/licenses/gpl-license.php
 * Text Domain: woocommerce-pdf-invoices-packing-slips
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( !class_exists( 'WCPDF_Custom_PDF_Maker_mPDF' ) ) :

class WCPDF_Custom_PDF_Maker_mPDF {
	public $html;
	public $settings;

	public function __construct( $html, $settings = array() ) {
		$this->html = $html;

		$default_settings = array(
			'paper_size'		=> 'A4',
			'paper_orientation'	=> 'portrait',
		);
		$this->settings = $settings + $default_settings;
	}

	public function output() {
		if ( empty( $this->html ) ) {
			return;
		}
		
		require_once __DIR__ . '/vendor/autoload.php';

		// convert orientation
		if (isset($this->settings['paper_orientation'])) {
			$orientation = $this->settings['paper_orientation'] == 'portrait' ? 'P' : 'L';
		} else {
			$orientation = 'P';
		}

		$options = array(
	        'mode'			=> 'utf-8', 
			'format'		=> $this->settings['paper_size'],
			'orientation'	=> $orientation,
			'tempDir'		=> WPO_WCPDF()->main->get_tmp_path('dompdf'),
		);

		try {
			$mpdf = new \Mpdf\Mpdf( $options );
			$mpdf->WriteHTML( $this->html );

			return $mpdf->Output( null, \Mpdf\Output\Destination::STRING_RETURN);
		} catch (Exception $e) {
			return;
		}
	}
}

endif; // class_exists

add_filter( 'wpo_wcpdf_pdf_maker', 'wpo_wcpdf_pdf_maker_mpdf' );
function wpo_wcpdf_pdf_maker_mpdf( $class ) {
	$class = 'WCPDF_Custom_PDF_Maker_mPDF';
	return $class;
}