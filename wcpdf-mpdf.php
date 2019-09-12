<?php
/**
 * Plugin Name: WooCommerce PDF Invoices & Packing Slips + mPDF
 * Plugin URI: http://www.wpovernight.com
 * Description: Uses mPDF instead of dompdf for HTML to PDF conversion
 * Version: 2.1.0
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

		$options = apply_filters( 'wpo_wcpdf_mpdf_options', array(
			'mode'				=> 'utf-8', 
			'format'			=> $this->settings['paper_size'],
			'orientation'		=> $orientation,
			'tempDir'			=> WPO_WCPDF()->main->get_tmp_path('dompdf'),
			'debug'				=> true,
			'useSubstitutions'	=> file_exists( __DIR__ . '/vendor/mpdf/mpdf/ttfonts/FreeSans.ttf' ),
		) );

		try {
			error_clear_last();
			$mpdf = new \Mpdf\Mpdf( $options );
			$mpdf->WriteHTML( $this->html );

			return $mpdf->Output( null, \Mpdf\Output\Destination::STRING_RETURN);
		} catch (Exception $e) {
			$logger = wc_get_logger();
			$logger->critical( $e->getMessage(), array( 'source' => 'woocommerce-pdf-ips-mpdf' ) );
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

// Add custom templates to settings page listing
add_filter( 'wpo_wcpdf_template_paths', 'wpo_wcpdf_add_mpdf_templates' );
function wpo_wcpdf_add_mpdf_templates( $template_paths ) {
	$template_paths['mpdf_templates'] = plugin_dir_path( __FILE__ ) . 'templates/';
	return $template_paths;
}

add_filter( 'wpo_wcpdf_header_logo_img_element', 'wpo_wcpdf_mpdf_set_logo_height', 10, 3 );
function wpo_wcpdf_mpdf_set_logo_height( $img_element, $attachment, $document ) {
	$style = apply_filters( 'wpo_wcpdf_mpdf_logo_styles', 'max-height: 3cm; width: auto;', $document );
	$img_element = str_replace('alt=', 'style="'.$style.'" alt=', $img_element);
	return $img_element;
}

add_filter( 'wpo_wcpdf_template_file', 'wpo_wcpdf_mpdf_auto_replace_simple_template_files', 10, 3 );
function wpo_wcpdf_mpdf_auto_replace_simple_template_files( $file_path, $document_type, $order ) {
	$file_path = str_replace("\\", "/", $file_path);
	$simple_path = str_replace("\\", "/", WPO_WCPDF()->plugin_path() . '/templates/Simple/' );
	if ( strpos( $file_path, $simple_path ) !== false ) {
		$mpdf_simple_path = plugin_dir_path( __FILE__ ) . 'templates/Simple mpdf/';
		$mpdf_file_path = str_replace( $simple_path, $mpdf_simple_path, $file_path );
		if (file_exists($mpdf_file_path)) {
			$file_path = $mpdf_file_path;
		}
	}
	return $file_path;
}