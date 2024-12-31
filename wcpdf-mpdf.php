<?php
/**
 * Plugin Name:      PDF Invoices & Packing Slips for WooCommerce - mPDF
 * Requires Plugins: woocommerce-pdf-invoices-packing-slips
 * Plugin URI:       https://github.com/wpovernight/woocommerce-pdf-ips-mpdf
 * Description:      Utilizes the mPDF engine as an alternative for converting HTML to PDF.
 * Version:          2.5.4
 * Update URI:       https://github.com/wpovernight/woocommerce-pdf-ips-mpdf
 * Author:           WP Overnight
 * Author URI:       https://www.wpovernight.com
 * License:          GPLv2 or later
 * License URI:      https://opensource.org/licenses/gpl-license.php
 * Text Domain:      woocommerce-pdf-ips-mpdf
 */

use Symfony\Component\DomCrawler\Crawler;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$plugin_path           = plugin_dir_path( __FILE__ );
$plugin_directory_name = basename( $plugin_path );
$plugin_file           = $plugin_directory_name . '/wcpdf-mpdf.php';
$github_updater_file   = $plugin_path . 'github-updater/GitHubUpdater.php';

if ( ! class_exists( '\\WPO\\GitHubUpdater\\GitHubUpdater' ) && file_exists( $github_updater_file ) ) {
	require_once $github_updater_file;
}

if ( class_exists( '\\WPO\\GitHubUpdater\\GitHubUpdater' ) ) {
	$gitHubUpdater = new \WPO\GitHubUpdater\GitHubUpdater( $plugin_file );
	$gitHubUpdater->setChangelog( 'CHANGELOG.md' );
	$gitHubUpdater->add();
}

if ( ! class_exists( 'WCPDF_Custom_PDF_Maker_mPDF' ) ) :

class WCPDF_Custom_PDF_Maker_mPDF {
	
	public $html;
	public $settings;
	public $document;

	public function __construct( $html, $settings = array(), $document = null ) {
		$this->html     = $html;
		$this->document = $document;

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
		if ( isset( $this->settings['paper_orientation'] ) ) {
			$orientation = 'portrait' === $this->settings['paper_orientation'] ? 'P' : 'L';
		} else {
			$orientation = 'P';
		}

		$options = apply_filters( 'wpo_wcpdf_mpdf_options', array(
			'mode'             => 'utf-8', 
			'format'           => $this->settings['paper_size'],
			'orientation'      => $orientation,
			'tempDir'          => WPO_WCPDF()->main->get_tmp_path( 'dompdf' ),
			'debug'            => true,
			'useSubstitutions' => file_exists( __DIR__ . '/vendor/mpdf/mpdf/ttfonts/FreeSans.ttf' ),
		) );

		try {
			error_clear_last();
			$mpdf = new \Mpdf\Mpdf( $options );
			$mpdf = apply_filters( 'wpo_wcpdf_before_mpdf_write', $mpdf, $this->html, $options, $this->document );
			$mpdf->WriteHTML( $this->html );
			$mpdf = apply_filters( 'wpo_wcpdf_after_mpdf_write', $mpdf, $this->html, $options, $this->document );
			
			return $mpdf->Output( null, \Mpdf\Output\Destination::STRING_RETURN );
		} catch ( Exception $e ) {
			$logger = wc_get_logger();
			$logger->critical( $e->getMessage(), array( 'source' => 'woocommerce-pdf-ips-mpdf' ) );
			return;
		}
	}
}

endif; // class_exists

add_action( 'init', 'wpo_wcpdf_mpdf_load_translations' );
function wpo_wcpdf_mpdf_load_translations(): void {
	load_plugin_textdomain( 'woocommerce-pdf-ips-mpdf', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

add_filter( 'wpo_wcpdf_pdf_maker', 'wpo_wcpdf_pdf_maker_mpdf' );
function wpo_wcpdf_pdf_maker_mpdf( string $class ): string {
	if ( ! wpo_wcpdf_mpdf_check_dependencies() ) {
		return $class;
	}

	return 'WCPDF_Custom_PDF_Maker_mPDF';
}

add_action( 'admin_init', 'wpo_wcpdf_mpdf_check_dependencies' );
function wpo_wcpdf_mpdf_check_dependencies(): bool {
	$activated_plugins       = array_merge( get_option( 'active_plugins', array() ), get_site_option( 'active_sitewide_plugins', array() ) );
	$core_plugin_slug        = 'woocommerce-pdf-invoices-packing-slips/woocommerce-pdf-invoices-packingslips.php';
	$core_plugin_min_version = '3.8.7';

	if (
		! ( in_array( $core_plugin_slug, $activated_plugins ) || array_key_exists( $core_plugin_slug, $activated_plugins ) ) ||
		! defined( 'WPO_WCPDF_VERSION' ) ||
		version_compare( WPO_WCPDF_VERSION, $core_plugin_min_version, '<' )
	) {
		add_action( 'admin_notices', 'wpo_wcpdf_mpdf_notice_core_plugin_requirement' );
		return false;
	}

	return true;
}

function wpo_wcpdf_mpdf_notice_core_plugin_requirement(): void {
	$error_message = sprintf(
		/* translators: 1. Plugin name, 2: Core plugin version, 3: Core plugin name */
		__( '%1$s requires at least version %2$s of %3$s to be installed and activated.', 'woocommerce-pdf-ips-mpdf' ),
		'<strong>PDF Invoices & Packing Slips for WooCommerce - mPDF</strong>',
		'<strong>3.8.4</strong>',
		'<a href="https://wordpress.org/plugins/woocommerce-pdf-invoices-packing-slips/">PDF Invoices & Packing Slips for WooCommerce</a>'
	);

	printf( '<div class="notice notice-error"><p>%s</p></div>', $error_message );
}

add_filter( 'wpo_wcpdf_header_logo_img_element', 'wpo_wcpdf_mpdf_set_logo_height', 10, 3 );
function wpo_wcpdf_mpdf_set_logo_height( $img_element, $attachment, $document ) {
	$max_height = '3cm';
	
	if ( ! empty( $document ) && is_callable( array( $document, 'get_header_logo_height' ) ) ) {
		$header_logo_height = $document->get_header_logo_height();
		if ( $header_logo_height ) {
			$max_height = $header_logo_height;
		}
	}

	$style       = apply_filters( 'wpo_wcpdf_mpdf_logo_styles', sprintf( 'max-height: %s; width: auto;', $max_height ), $document );
	$img_element = str_replace( 'alt=', 'style="'.$style.'" alt=', $img_element );
	
	return $img_element;
}

add_filter( 'wpo_wcpdf_get_html', 'wpo_wcpdf_mpdf_modify_html', 10, 2 );
function wpo_wcpdf_mpdf_modify_html( $html, $document ) {
	require_once __DIR__ . '/vendor/autoload.php';
	
	if ( ! class_exists( 'DOMDocument' ) ) {
		return $html;
	}

	$partial_html = stripos( $html, "</html>" ) === false; // for bulk documents

	if ( apply_filters( 'wpo_wcpdf_mpdf_domdocument_debug', false ) ) {
		$crawler = new Crawler( $html );
	} else {
		@$crawler = new Crawler( $html );
	}

	// remove image attributes and replace by inline styles
	$crawler->filter( 'td.thumbnail img' )->each( function ( Crawler $crawler, $i ) {
		foreach ( $crawler as $img ) {
			$img->removeAttribute( 'width' );
			$img->removeAttribute( 'height' );
			$img->setAttribute( 'style', 'width:13mm;height:auto;' );
		}
	} );

	// replace strong tags with span tags and add class 'label'
	$crawler->filter( '.wc-item-meta strong' )->each( function ( Crawler $crawler, $i ) {
		foreach ( $crawler as $strong ) {
			$span = $strong->ownerDocument->createElement( 'span', $strong->nodeValue );
			$span->setAttribute( 'class', 'label' );
			$strong->parentNode->replaceChild( $span, $strong );
		}
	} );

	// remove p tags but keep the content inside
	$crawler->filter( '.wc-item-meta p' )->each( function ( Crawler $crawler, $i ) {
		foreach ( $crawler as $p ) {
			while ( $p->firstChild ) {
				$p->parentNode->insertBefore( $p->firstChild, $p );
			}
			$p->parentNode->removeChild( $p );
		}
	} );

	// replace ul.wc-item-meta with div and wrap each li content in a p
	$crawler->filter( 'ul.wc-item-meta' )->each( function ( Crawler $crawler, $i ) {
		foreach ( $crawler as $ul ) {
			$div = $ul->ownerDocument->createElement( 'div' );
			$div->setAttribute( 'class', 'wc-item-meta' );
			
			foreach ( $ul->childNodes as $li ) {
				if ( $li->nodeType === XML_ELEMENT_NODE && 'li' === strtolower( $li->nodeName ) ) {
					$p = $ul->ownerDocument->createElement( 'p' );
					
					foreach ( $li->childNodes as $child ) {
						// Replace <strong> with <span class="label">
						if ( $child->nodeType === XML_ELEMENT_NODE && 'strong' === strtolower( $child->nodeName ) ) {
							$span = $ul->ownerDocument->createElement( 'span', $child->textContent );
							$span->setAttribute( 'class', 'label' );
							$p->appendChild( $span );
						}
						
						// Append content of <dd> or <p> to the <p> element
						elseif ( $child->nodeType === XML_ELEMENT_NODE && in_array( strtolower( $child->nodeName ), array( 'dd', 'p' ) ) ) {
							foreach ( $child->childNodes as $grandchild ) {
								$clonedNode = $grandchild->cloneNode( true );
								$p->appendChild( $clonedNode );
							}
						}
						
						// Handle all other nodes (including text nodes)
						else {
							$clonedNode = $child->cloneNode( true );
							$p->appendChild( $clonedNode );
						}
					}
					
					// Append the <p> to the <div>
					$div->appendChild( $p );
				}
			}
			
			// Replace the <ul> with the new <div>
			$ul->parentNode->replaceChild( $div, $ul );
		}
	} );

	// create html
	if ( $partial_html ) {
		// html and body are automatically added when partial HTML is loaded,
		// but we don't want that in the resulting HTML
		$html = '';
		foreach ( $crawler->filter( 'body' )->children() as $domElement ) {
			$html .= $domElement->ownerDocument->saveHTML( $domElement );
		}
	} else {
		$html = $crawler->html();
	}

	return $html;
}

add_action( 'wpo_wcpdf_custom_styles', 'wpo_wcpdf_mpdf_premium_style_overrides', 10, 2 );
function wpo_wcpdf_mpdf_premium_style_overrides( $document_type, $document = null ) {
	$template_name = basename( WPO_WCPDF()->settings->get_template_path() );
	$margins       = array(
		'Simple'         => array( '0','20mm','20mm' ), // bottom, left, right
		'Business'       => array( '10mm','10mm','10mm' ),
		'Modern'         => array( '10mm','10mm','10mm' ),
		'Simple Premium' => array( '10mm','20mm','20mm' ),
	);
	
	if ( array_key_exists( $template_name, $margins ) ) {
		printf( "\n#footer, .foot { bottom: %s; left: %s; right: %s; }\n", $margins[ $template_name ][0], $margins[ $template_name ][1], $margins[ $template_name ][2] );
	}
}

// remove from WooCommerce compatibility checklist
add_filter( 'woocommerce_get_plugins_for_woocommerce', function( $matches, $plugins ) {
	foreach ( $matches as $basename => $plugin_data ) {
		if ( $basename == plugin_basename( __FILE__ ) ) {
			unset( $matches[ $basename ] );
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
		'title'    => __( 'RTL support', 'woocommerce-pdf-ips-mpdf' ),
		'callback' => 'checkbox',
		'section'  => 'general_settings',
		'args'     => array(
			'option_name' => $option_name,
			'id'          => 'rtl_support',
			'description' => __( 'Enables RTL support natively for templates.', 'woocommerce-pdf-ips-mpdf' ),
		)
	);

	return $settings_fields;
}

// adds a wrapper div to the html content with .rtl and .mpdf classes
add_filter( 'wpo_wcpdf_html_content', 'wpo_wcpdf_mpdf_wrap_html_content', 10, 1 );
function wpo_wcpdf_mpdf_wrap_html_content( $content ) {
	$general_settings = get_option( 'wpo_wcpdf_settings_general' );
	$classes          ='mpdf';

	if ( ! empty( $general_settings['rtl_support'] ) ) {
		$classes .= ' rtl';
	}

	$content = '<div class="'.$classes.'">'.$content.'</div>';

	return $content;
}