<?php
/**
 * Plugin Name:          PDF Invoices & Packing Slips for WooCommerce - mPDF
 * Requires Plugins:     woocommerce-pdf-invoices-packing-slips
 * Plugin URI:           https://github.com/wpovernight/woocommerce-pdf-ips-mpdf
 * Description:          Utilizes the mPDF engine as an alternative for converting HTML to PDF.
 * Version:              3.2.0
 * Requires at least:    5.9
 * Requires PHP:         8.1
 * Update URI:           https://github.com/wpovernight/woocommerce-pdf-ips-mpdf
 * Author:               WP Overnight
 * Author URI:           https://www.wpovernight.com
 * License:              GPLv2 or later
 * License URI:          https://opensource.org/licenses/gpl-license.php
 * Text Domain:          woocommerce-pdf-ips-mpdf
 * WC requires at least: 4.0
 */

use Symfony\Component\DomCrawler\Crawler;
use WPO\IPS\Mpdf\Vendor\Mpdf\Mpdf;
use WPO\IPS\Mpdf\Vendor\Mpdf\Output\Destination;
use WPO\IPS\EDI\Document as EDI_Document;
use WPO\IPS\EDI\SabreBuilder as EDI_SabreBuilder;
use WPO\IPS\EDI\Interfaces\HybridFormatInterface;
use WPO\IPS\Mpdf\RemoteClient;
use WPO\IPS\Mpdf\ResourceContainer;
use WPO\IPS\Vendor\Dompdf\Options;

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

require $plugin_path . '/vendor/autoload.php';
require $plugin_path . '/vendor/strauss/autoload.php';
require_once $plugin_path . '/includes/RemoteClient.php';
require_once $plugin_path . '/includes/ResourceContainer.php';

if ( class_exists( '\\WPO\\IPS\\Makers\\PDFMaker' ) && ! class_exists( 'WCPDF_Custom_PDF_Maker_mPDF' ) ) :

class WCPDF_Custom_PDF_Maker_mPDF extends \WPO\IPS\Makers\PDFMaker {

	public bool $hybrid;

	/**
	 * Constructor.
	 *
	 * @param string $html Document HTML.
	 * @param array $settings PDF settings.
	 * @param object|null $document Document instance.
	 */
	public function __construct( string $html, array $settings = array(), ?object $document = null ) {
		parent::__construct( $html, $settings, $document );

		$this->hybrid = $this->is_hybrid_document();
	}

	/**
	 * Output the PDF.
	 *
	 * @return string|null
	 */
	public function output(): ?string {
		if ( empty( $this->html ) ) {
			return null;
		}

		$tmp_path = WPO_WCPDF()->get_instance( 'main' )->ensure_tmp_path( 'dompdf' );

		if ( false === $tmp_path ) {
			wcpdf_log_error( 'PDF temporary folder is not available.', 'critical' );
			return null;
		}

		// convert orientation
		if ( isset( $this->settings['paper_orientation'] ) ) {
			$orientation = ( 'portrait' === $this->settings['paper_orientation'] )
				? 'P'
				: 'L';
		} else {
			$orientation = 'P';
		}

		$options = apply_filters( 'wpo_wcpdf_mpdf_options', array(
			'mode'             => 'utf-8', 
			'format'           => $this->settings['paper_size'],
			'orientation'      => $orientation,
			'tempDir'          => $tmp_path,
			'debug'            => false,
			'useSubstitutions' => file_exists( __DIR__ . '/vendor/mpdf/mpdf/ttfonts/FreeSans.ttf' ),
		) );
		
		if ( $this->hybrid ) {
			$options = $this->set_pdfa_enabled( $options );
		}

		try {
			error_clear_last();
			$resource_options = new Options( array( 'isRemoteEnabled' => true ) );
			$this->restrict_remote_resources( $resource_options );

			$container = new ResourceContainer( new RemoteClient( $resource_options ) );
			$mpdf      = new Mpdf( $options, $container );
			$container->set_mpdf( $mpdf );

			$mpdf = apply_filters( 'wpo_wcpdf_before_mpdf_write', $mpdf, $this->html, $options, $this->document );
			
			if ( $this->hybrid ) {
				$mpdf = $this->set_pdfa_file( $mpdf );

				if ( null === $mpdf ) {
					return null;
				}
			}
			
			$mpdf->WriteHTML( $this->html );
			$mpdf = apply_filters( 'wpo_wcpdf_after_mpdf_write', $mpdf, $this->html, $options, $this->document );
			
			return $mpdf->Output( null, Destination::STRING_RETURN );
		} catch ( \Throwable $e ) {
			wcpdf_log_error( $e->getMessage(), 'critical', $e, 'woocommerce-pdf-ips-mpdf' );
			return null;
		}
	}
	
	/**
	 * Set PDF/A enabled options.
	 *
	 * @param array $options
	 * @return array
	 */
	private function set_pdfa_enabled( array $options ): array {
		$options['PDFA']     = true;
		$options['PDFAauto'] = true;
		return $options;
	}
	
	/**
	 * Set PDF/A file in mPDF.
	 *
	 * @param Mpdf $mpdf
	 * @return Mpdf|null
	 */
	private function set_pdfa_file( Mpdf $mpdf ): ?Mpdf {
		if (
			! function_exists( 'wpo_ips_edi_get_current_format' )  ||
			! function_exists( 'wpo_ips_edi_get_current_syntax' )  ||
			! class_exists( 'WPO\IPS\EDI\Document' )               ||
			! class_exists( 'WPO\IPS\EDI\SabreBuilder' )           ||
			! is_callable( array( $mpdf, 'SetAssociatedFiles' ) )  ||
			! is_callable( array( $mpdf, 'SetAdditionalXmpRdf' ) )
		) {
			wc_get_logger()->error( 'Required functions or methods are not available for setting EDI files.', array( 'source' => 'woocommerce-pdf-ips-mpdf' ) );
			return null;
		}

		$mpdf->PDFAversion = '3-B'; // Set PDF/A version to 3-B

		$format = wpo_ips_edi_get_current_format();
		
		if ( empty( $format ) || ! is_string( $format ) ) {
			wc_get_logger()->error( 'EDI format is not available.', array( 'source' => 'woocommerce-pdf-ips-mpdf' ) );
			return null;
		}
		
		$syntax = wpo_ips_edi_get_current_syntax();
		
		if ( empty( $syntax ) ) {
			wc_get_logger()->error( 'EDI syntax is not available.', array( 'source' => 'woocommerce-pdf-ips-mpdf' ) );
			return null;
		}

		$edi_document = new EDI_Document( $syntax, $format, $this->document );
		
		if ( ! $edi_document ) {
			wc_get_logger()->error( 'EDI document could not be created.', array( 'source' => 'woocommerce-pdf-ips-mpdf' ) );
			return null;
		}

		$builder = new EDI_SabreBuilder();
		$content = apply_filters(
			'wpo_ips_edi_contents',
			$builder->build( $edi_document ),
			$edi_document,
			$this->document
		);

		if ( empty( $content ) ) {
			wc_get_logger()->error( 'EDI document content is empty.', array( 'source' => 'woocommerce-pdf-ips-mpdf' ) );
			return null;
		}
		
		$edi_format_document = $edi_document->get_format_document();

		if ( ! $edi_format_document instanceof HybridFormatInterface ) {
			wc_get_logger()->error( 'EDI format document does not support hybrid PDF metadata.', array( 'source' => 'woocommerce-pdf-ips-mpdf' ) );
			return null;
		}
		
		$mpdf->SetAssociatedFiles( array( array(
			'name'           => $edi_format_document->get_document_filename(),
			'mime'           => 'text/xml',
			'description'    => $format,
			'AFRelationship' => 'Alternative',
			'content'        => $content,
		) ) );

		$mpdf->SetAdditionalXmpRdf( $edi_format_document->get_rdf_metadata() );
		
		return $mpdf;
	}
	
}

endif;

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
	$core_plugin_min_version = '6.0.0';

	if (
		! ( in_array( $core_plugin_slug, $activated_plugins ) || array_key_exists( $core_plugin_slug, $activated_plugins ) ) ||
		! defined( 'WPO_WCPDF_VERSION' ) ||
		// Accept V6 prereleases only when the required core helper is available.
		version_compare( strtok( WPO_WCPDF_VERSION, '-' ), $core_plugin_min_version, '<' ) ||
		! method_exists( 'WCPDF_Custom_PDF_Maker_mPDF', 'is_hybrid_document' )
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
		'<strong>6.0.0</strong>',
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
/**
 * Adapt document HTML for mPDF while preserving text content.
 *
 * @param string $html Document HTML.
 * @param object $document Document instance.
 * @return string
 */
function wpo_wcpdf_mpdf_modify_html( string $html, object $document ): string {
	if ( ! class_exists( 'DOMDocument' ) ) {
		return $html;
	}
	
	// If CssSelector is not available, bail early to avoid exceptions.
	if ( ! class_exists( \Symfony\Component\CssSelector\CssSelectorConverter::class ) ) {
		wc_get_logger()->error( 'Symfony CssSelector component is not available.', array( 'source' => 'woocommerce-pdf-ips-mpdf' ) );
		return $html;
	}

	$partial_html = stripos( $html, "</html>" ) === false; // for bulk documents

	$crawler = apply_filters( 'wpo_wcpdf_mpdf_domdocument_debug', false )
		? new Crawler( $html )
		: @new Crawler( $html );

	// remove image attributes and replace by inline styles
	$thumb_selector    = apply_filters( 'wpo_wcpdf_mpdf_thumbnail_selector', 'td.thumbnail img', $document );
	$thumb_style       = apply_filters( 'wpo_wcpdf_mpdf_thumbnail_img_style', 'width:13mm;height:auto;', $document );
	$thumb_remove_size = (bool) apply_filters( 'wpo_wcpdf_mpdf_thumbnail_remove_size_attrs', true, $document );

	$crawler->filter( $thumb_selector )->each( function ( Crawler $crawler, $i ) use ( $thumb_remove_size, $thumb_style ) {
		foreach ( $crawler as $img ) {
			if ( $thumb_remove_size ) {
				$img->removeAttribute( 'width' );
				$img->removeAttribute( 'height' );
			}
			$img->setAttribute( 'style', $thumb_style );
		}
	} );

	// replace strong tags with span tags and add class 'label'
	$crawler->filter( '.wc-item-meta strong' )->each( function ( Crawler $crawler, $i ) {
		foreach ( $crawler as $strong ) {
			$span = $strong->ownerDocument->createElement( 'span' );
			$span->appendChild( $strong->ownerDocument->createTextNode( $strong->textContent ) );
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
							$span = $ul->ownerDocument->createElement( 'span' );
							$span->appendChild( $ul->ownerDocument->createTextNode( $child->textContent ) );
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
