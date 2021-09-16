<?php
/**
 * Plugin Name: WooCommerce PDF Invoices & Packing Slips + mPDF
 * Plugin URI: http://www.wpovernight.com
 * Description: Uses mPDF instead of dompdf for HTML to PDF conversion
 * Version: 2.3.0
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
	$max_height = '3cm';
	if ( !empty($document) && is_callable(array($document,'get_header_logo_height')) && $header_logo_height = $document->get_header_logo_height() ) {
		$max_height = $header_logo_height;
	}

	$style = apply_filters( 'wpo_wcpdf_mpdf_logo_styles', sprintf('max-height: %s; width: auto;', $max_height), $document );
	$img_element = str_replace('alt=', 'style="'.$style.'" alt=', $img_element);
	return $img_element;
}

add_filter( 'wpo_wcpdf_get_html', 'wpo_wcpdf_modify_html', 10, 2);
function wpo_wcpdf_modify_html( $html, $document ) {
	if ( !class_exists('DOMDocument') || stripos( $html, "</html>" ) === false ) {
		return $html;
	}
	$dom = new DOMDocument();
	if ( apply_filters( 'wpo_wcpdf_mpdf_domdocument_debug', false ) ) {
		$dom->loadHTML($html);
	} else {
		@$dom->loadHTML($html);
	}

	// remove image attributes and replace by inline styles
	$tds = $dom->getElementsByTagName("td");
	foreach ($tds as $td) {
		if (stripos($td->getAttribute('class'), 'thumbnail') === false) {
			continue;
		}
		$images = $td->getElementsByTagName("img");
		foreach ($images as $image) {
			$image->removeAttribute('width');
			$image->removeAttribute('height');
			$image->setAttribute('style','width:13mm;height:auto;');
		}
	}

	// remove p tags from wc-item-meta
	$ps = $dom->getElementsByTagName("p");
	if( ! empty($ps) ) {
		for ($i = $ps->length - 1; $i > -1 ; $i--) {
			$p = $ps->item($i);
			if ($p->parentNode->nodeName === 'li' && stripos($p->parentNode->parentNode->getAttribute('class'), 'wc-item-meta') !== false) {
				$span = $dom->createElement("span", $p->nodeValue);
				$p->parentNode->replaceChild($span, $p);
			}
		}
	}

	$html = $dom->saveHTML($dom);
	return $html;
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

add_action( 'wpo_wcpdf_custom_styles', 'wpo_wcpdf_mpdf_premium_style_overrides', 10, 2 );
function wpo_wcpdf_mpdf_premium_style_overrides( $document_type, $document = null ) {
	if ( defined('WPO_WCPDF_TEMPLATES_VERSION') && version_compare( WPO_WCPDF_TEMPLATES_VERSION, '2.4', '>' ) ) {
		$template_name = basename( WPO_WCPDF()->settings->get_template_path() );
		$margins = array(
			'Business'       => array('10mm','10mm','10mm'), // bottom, left, right
			'Modern'         => array('10mm','10mm','10mm'),
			'Simple Premium' => array('10mm','20mm','20mm'),
		);
		if ( array_key_exists( $template_name, $margins ) ) {
			printf( "\n#footer, .foot { bottom: %s; left: %s; right: %s; }\n", $margins[$template_name][0], $margins[$template_name][1], $margins[$template_name][2]);
		}
	}
}

// remove from WooCommerce compatibility checklist
add_filter( 'woocommerce_get_plugins_for_woocommerce', function( $matches, $plugins ) {
	foreach ( $matches as $basename => $plugin_data ) {
		if ( $basename == plugin_basename( __FILE__ ) ) {
			unset( $matches[$basename] );
		}
	}
	return $matches;
}, 10, 2 );

// add RTL support option to general settings
add_filter( 'wpo_wcpdf_settings_fields_general', 'wpo_wcpdf_mpdf_rtl_support', 10, 4 );
function wpo_wcpdf_mpdf_rtl_support( $settings_fields, $page, $option_group, $option_name ) {
	$settings_fields[] = array(
		'type'     => 'setting',
		'id'       => 'rtl_support',
		'title'    => __( 'RTL support', 'woocommerce-pdf-invoices-packing-slips' ),
		'callback' => 'checkbox',
		'section'  => 'general_settings',
		'args'     => array(
			'option_name' => $option_name,
			'id'          => 'rtl_support',
			'description' => __( 'Enables RTL support natively for templates.', 'woocommerce-pdf-invoices-packing-slips' ),
		)
	);

	return $settings_fields;
}

// adds a wrapper div to the html content with .rtl and .mpdf classes
add_filter( 'wpo_wcpdf_html_content', 'wpo_wcpdf_mpdf_wrap_html_content', 10, 1 );
function wpo_wcpdf_mpdf_wrap_html_content( $content ) {
	$general_settings = get_option('wpo_wcpdf_settings_general');
	$classes          ='mpdf';

	if( ! empty( $general_settings['rtl_support'] ) ) {
		$classes .= ' rtl';
	}

	$content = '<div class="'.$classes.'">'.$content.'</div>';

	return $content;
}