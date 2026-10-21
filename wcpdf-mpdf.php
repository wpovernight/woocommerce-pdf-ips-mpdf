<?php
/**
 * Plugin Name:          PDF Invoices & Packing Slips for WooCommerce - mPDF
 * Requires Plugins:     woocommerce-pdf-invoices-packing-slips
 * Plugin URI:           https://github.com/wpovernight/woocommerce-pdf-ips-mpdf
 * Description:          Utilizes the mPDF engine as an alternative for converting HTML to PDF.
 * Version:              3.2.0
 * Requires at least:    5.9
 * Requires PHP:         8.1
 * WC requires at least: 4.0
 * Update URI:           https://github.com/wpovernight/woocommerce-pdf-ips-mpdf
 * Author:               WP Overnight
 * Author URI:           https://www.wpovernight.com
 * License:              GPLv2 or later
 * License URI:          https://opensource.org/licenses/gpl-license.php
 * Text Domain:          woocommerce-pdf-ips-mpdf
 */

use Symfony\Component\DomCrawler\Crawler;
use WPO\IPS\Mpdf\ResourceContainer;
use WPO\IPS\Mpdf\RemoteClient;
use WPO\IPS\Mpdf\Vendor\Mpdf\Mpdf;
use WPO\IPS\Mpdf\Vendor\Mpdf\Output\Destination;
use WPO\IPS\Mpdf\Vendor\Mpdf\Config\ConfigVariables;
use WPO\IPS\Mpdf\Vendor\Mpdf\Config\FontVariables;
use WPO\IPS\EDI\Document as EDI_Document;
use WPO\IPS\EDI\SabreBuilder as EDI_SabreBuilder;

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

/**
 * Compatibility base class.
 *
 * In PDF Invoices & Packing Slips v6, PDF makers must extend \WPO\IPS\Makers\PDFMaker.
 * Older versions do not have that class, so we keep a fallback base class with the
 * legacy constructor/properties.
 */
if ( ! class_exists( 'WCPDF_Custom_PDF_Maker_mPDF_Base' ) ) {
	if ( function_exists( 'WPO_WCPDF' ) && ! class_exists( '\\WPO\\IPS\\Makers\\PDFMaker' ) ) {
		$pdf_maker_file = WPO_WCPDF()->plugin_path() . '/includes/Makers/PDFMaker.php';

		if ( file_exists( $pdf_maker_file ) ) {
			include_once $pdf_maker_file;
		}
	}

	if ( class_exists( '\\WPO\\IPS\\Makers\\PDFMaker' ) ) {
		/**
		 * Use the core PDF maker contract when available.
		 */
		abstract class WCPDF_Custom_PDF_Maker_mPDF_Base extends \WPO\IPS\Makers\PDFMaker {}
	} else {
		/**
		 * Provide the PDF maker contract for older core versions.
		 */
		abstract class WCPDF_Custom_PDF_Maker_mPDF_Base {

			/** @var string Document HTML. */
			public string $html;
			/** @var array PDF rendering settings. */
			public array $settings;
			/** @var object|null Order or bulk document being rendered. */
			public ?object $document;

			/**
			 * Initialize the legacy PDF maker.
			 *
			 * @param string      $html     Document HTML.
			 * @param array       $settings PDF rendering settings.
			 * @param object|null $document Order or bulk document.
			 */
			public function __construct( string $html, array $settings = array(), ?object $document = null ) {
				$this->html     = $html;
				$this->document = $document;

				$default_settings = array(
					'paper_size'        => 'A4',
					'paper_orientation' => 'portrait',
				);

				$this->settings = array_merge( $default_settings, $settings );
			}
		}
	}
}

if ( ! class_exists( 'WCPDF_Custom_PDF_Maker_mPDF' ) ) :

/**
 * Render core document HTML with mPDF, including hybrid e-invoices.
 */
class WCPDF_Custom_PDF_Maker_mPDF extends WCPDF_Custom_PDF_Maker_mPDF_Base {

	/** @var bool Whether the document requires an embedded XML invoice. */
	public bool $hybrid;

	/**
	 * Initialize the renderer and determine whether XML embedding is required.
	 *
	 * @param string      $html     Document HTML.
	 * @param array       $settings PDF rendering settings.
	 * @param object|null $document Order or bulk document.
	 */
	public function __construct( string $html, array $settings = array(), ?object $document = null ) {
		parent::__construct( $html, $settings, $document );

		$this->hybrid = $this->is_hybrid_format();
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

		$core     = WPO_WCPDF();
		$main     = is_callable( array( $core, 'get_instance' ) ) ? $core->get_instance( 'main' ) : $core->main;
		$tmp_path = is_callable( array( $main, 'ensure_tmp_path' ) ) ? $main->ensure_tmp_path( 'dompdf' ) : $main->get_tmp_path( 'dompdf' );

		if ( ! $tmp_path ) {
			wcpdf_log_error( 'PDF temporary folder is not available.', 'critical', null, 'woocommerce-pdf-ips-mpdf' );
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
			'debug'            => isset( wpo_wcpdf_mpdf_get_settings( 'debug' )['enable_debug'] ),
			'useSubstitutions' => $this->has_substitution_font(),
			'percentSubset'    => array_key_exists( 'font_subsetting', $this->settings )
				? ( $this->settings['font_subsetting'] ? 100 : 0 )
				: ( new ConfigVariables() )->getDefaults()['percentSubset'],
		) );
		
		if ( $this->hybrid ) {
			$options = $this->set_pdfa_enabled( $options );
		}

		try {
			error_clear_last();
			$container = $this->get_resource_container();
			$mpdf      = new Mpdf( $options, $container );
			if ( $container ) {
				$container->set_mpdf( $mpdf );
			}
			$mpdf = apply_filters( 'wpo_wcpdf_before_mpdf_write', $mpdf, $this->html, $options, $this->document );
			
			if ( $this->hybrid && ! $this->set_pdfa_file( $mpdf ) ) {
				return null;
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
	 * Find the substitution font using mPDF's own font configuration.
	 *
	 * @return bool Whether the bundled FreeSans font is readable.
	 */
	private function has_substitution_font(): bool {
		$config = ( new ConfigVariables() )->getDefaults();
		$fonts  = ( new FontVariables() )->getDefaults();
		$file   = $fonts['fontdata']['freesans']['R'] ?? '';
		foreach ( (array) $config['fontDir'] as $directory ) {
			if ( '' !== $file && is_readable( $directory . '/' . $file ) ) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Use core's resource policy when available; retain the legacy loader on older core versions.
	 *
	 * @return ResourceContainer|null
	 */
	private function get_resource_container(): ?ResourceContainer {
		if (
			! function_exists( 'wpo_ips_get_trusted_resource_urls' ) ||
			! function_exists( 'wpo_ips_get_allowed_remote_hosts' ) ||
			! function_exists( 'wpo_ips_get_allowed_remote_ports' ) ||
			! function_exists( 'wpo_ips_is_allowed_remote_resource' )
		) {
			return null;
		}

		require_once __DIR__ . '/includes/RemoteClient.php';
		require_once __DIR__ . '/includes/ResourceContainer.php';

		$urls  = wpo_ips_get_trusted_resource_urls( $this->document );
		$hosts = wpo_ips_get_allowed_remote_hosts( $this->document, $urls );
		$ports = wpo_ips_get_allowed_remote_ports( $this->document, $urls );

		return new ResourceContainer( new RemoteClient( $hosts, $ports ) );
	}

	/**
	 * Check if the current document requires hybrid format.
	 *
	 * @return bool
	 */
	private function is_hybrid_format(): bool {
		if ( function_exists( 'wpo_ips_edi_is_hybrid_document' ) ) {
			return wpo_ips_edi_is_hybrid_document( $this->document );
		}

		// Compatibility with core releases before the shared hybrid-format helper.
		if ( ! function_exists( 'wpo_ips_edi_is_available' ) || ! wpo_ips_edi_is_available() ) {
			return false;
		}

		$format = wpo_ips_edi_get_current_format( true );
		if ( ! is_array( $format ) || empty( $format['hybrid'] ) ) {
			return false;
		}

		$document_types = isset( $format['documents'] ) && is_array( $format['documents'] ) ? array_keys( $format['documents'] ) : array();
		$document_type  = $this->document && is_callable( array( $this->document, 'get_type' ) ) ? $this->document->get_type() : '';

		return in_array( $document_type, $document_types, true );
	}
	
	/**
	 * Set PDF/A enabled options.
	 *
	 * @param array $options mPDF constructor options.
	 * @return array Options with PDF/A support enabled.
	 */
	private function set_pdfa_enabled( array $options ): array {
		$options['PDFA']     = true;
		$options['PDFAauto'] = true;
		return $options;
	}
	
	/**
	 * Set PDF/A file in mPDF.
	 *
	 * @param Mpdf $mpdf Renderer receiving the XML attachment and metadata.
	 * @return bool Whether the XML and metadata were attached successfully.
	 */
	private function set_pdfa_file( Mpdf $mpdf ): bool {
		if (
			! function_exists( 'wpo_ips_edi_get_current_format' )  ||
			! function_exists( 'wpo_ips_edi_get_current_syntax' )  ||
			! class_exists( 'WPO\IPS\EDI\Document' )               ||
			! class_exists( 'WPO\IPS\EDI\SabreBuilder' )           ||
			! is_callable( array( $mpdf, 'SetAssociatedFiles' ) )  ||
			! is_callable( array( $mpdf, 'SetAdditionalXmpRdf' ) )
		) {
			wcpdf_log_error( 'Required functions or methods are not available for setting EDI files.', 'error', null, 'woocommerce-pdf-ips-mpdf' );
			return false;
		}

		$mpdf->PDFAversion = '3-B'; // Set PDF/A version to 3-B

		if ( function_exists( 'wpo_ips_edi_build_document' ) ) {
			$data                = wpo_ips_edi_build_document( $this->document );
			$content             = $data['contents'];
			$edi_document        = $data['document'];
			$edi_format_document = $edi_document->format_document;
			$format              = $edi_document->format;
		} else {
			// Compatibility with core releases before the shared XML builder.
			$format = wpo_ips_edi_get_current_format();

			if ( empty( $format ) || ! is_string( $format ) ) {
				wcpdf_log_error( 'EDI format is not available.', 'error', null, 'woocommerce-pdf-ips-mpdf' );
				return false;
			}

			$syntax = wpo_ips_edi_get_current_syntax();

			if ( empty( $syntax ) ) {
				wcpdf_log_error( 'EDI syntax is not available.', 'error', null, 'woocommerce-pdf-ips-mpdf' );
				return false;
			}

			$edi_document = new EDI_Document( $syntax, $format, $this->document );

			$builder = new EDI_SabreBuilder();
			$content = apply_filters(
				'wpo_ips_edi_contents',
				$builder->build( $edi_document ),
				$edi_document,
				$this->document
			);

			if ( ! is_string( $content ) || '' === trim( $content ) ) {
				wcpdf_log_error( 'EDI document content is empty or invalid.', 'error', null, 'woocommerce-pdf-ips-mpdf' );
				return false;
			}

			$edi_format_document = $edi_document->get_format_document();
		}

		if ( ! $edi_format_document instanceof \WPO\IPS\EDI\Interfaces\HybridFormatInterface ) {
			wcpdf_log_error( 'EDI format document does not support hybrid PDF metadata.', 'error', null, 'woocommerce-pdf-ips-mpdf' );
			return false;
		}
		
		$mpdf->SetAssociatedFiles( array( array(
			'name'           => $edi_format_document->get_document_filename(),
			'mime'           => 'text/xml',
			'description'    => $format,
			'AFRelationship' => 'Alternative',
			'content'        => $content,
		) ) );

		$mpdf->SetAdditionalXmpRdf( $edi_format_document->get_rdf_metadata() );
		
		return true;
	}
	
}

endif;

add_action( 'init', 'wpo_wcpdf_mpdf_load_translations' );
/**
 * Load the extension's translations.
 *
 * @return void
 */
function wpo_wcpdf_mpdf_load_translations(): void {
	load_plugin_textdomain( 'woocommerce-pdf-ips-mpdf', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

add_filter( 'wpo_wcpdf_pdf_maker', 'wpo_wcpdf_pdf_maker_mpdf' );
/**
 * Select mPDF when the required core plugin is available.
 *
 * @param string $class Existing PDF maker class name.
 * @return string PDF maker class name.
 */
function wpo_wcpdf_pdf_maker_mpdf( string $class ): string {
	if ( ! wpo_wcpdf_mpdf_check_dependencies() ) {
		return $class;
	}

	return 'WCPDF_Custom_PDF_Maker_mPDF';
}

add_action( 'admin_init', 'wpo_wcpdf_mpdf_check_dependencies' );
/**
 * Check the core plugin dependency and register a notice if it is unavailable.
 *
 * @return bool Whether the required core plugin is active.
 */
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

/**
 * Display the minimum core plugin requirement.
 *
 * @return void
 */
function wpo_wcpdf_mpdf_notice_core_plugin_requirement(): void {
	$error_message = sprintf(
		/* translators: 1. Plugin name, 2: Core plugin version, 3: Core plugin name */
		__( '%1$s requires at least version %2$s of %3$s to be installed and activated.', 'woocommerce-pdf-ips-mpdf' ),
		'<strong>PDF Invoices & Packing Slips for WooCommerce - mPDF</strong>',
		'<strong>3.8.7</strong>',
		'<a href="https://wordpress.org/plugins/woocommerce-pdf-invoices-packing-slips/">PDF Invoices & Packing Slips for WooCommerce</a>'
	);

	printf( '<div class="notice notice-error"><p>%s</p></div>', $error_message );
}

add_filter( 'wpo_wcpdf_header_logo_img_element', 'wpo_wcpdf_mpdf_set_logo_height', 10, 3 );
/**
 * Apply an mPDF-compatible height to the document logo.
 *
 * @param string      $img_element Logo image HTML.
 * @param int         $attachment  Logo attachment ID.
 * @param object|null $document    Document providing the logo settings.
 * @return string Updated logo HTML.
 */
function wpo_wcpdf_mpdf_set_logo_height( string $img_element, int $attachment, ?object $document ): string {
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
 * Adapt thumbnails and item metadata to mPDF's supported HTML layout.
 *
 * @param string      $html     Complete document or bulk-document fragment.
 * @param object|null $document Document being rendered.
 * @return string Adapted document HTML.
 */
function wpo_wcpdf_mpdf_modify_html( string $html, ?object $document ): string {
	if ( ! class_exists( 'DOMDocument' ) ) {
		return $html;
	}
	
	// If CssSelector is not available, bail early to avoid exceptions.
	if ( ! class_exists( \Symfony\Component\CssSelector\CssSelectorConverter::class ) ) {
		wcpdf_log_error( 'Symfony CssSelector component is not available.', 'error', null, 'woocommerce-pdf-ips-mpdf' );
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

	$crawler->filter( $thumb_selector )->each( function ( Crawler $crawler, int $i ) use ( $thumb_remove_size, $thumb_style ): void {
		foreach ( $crawler as $img ) {
			if ( $thumb_remove_size ) {
				$img->removeAttribute( 'width' );
				$img->removeAttribute( 'height' );
			}
			$img->setAttribute( 'style', $thumb_style );
		}
	} );

	// replace strong tags with span tags and add class 'label'
	$crawler->filter( '.wc-item-meta strong' )->each( function ( Crawler $crawler, int $i ): void {
		foreach ( $crawler as $strong ) {
			$span = $strong->ownerDocument->createElement( 'span' );
			$span->appendChild( $strong->ownerDocument->createTextNode( $strong->nodeValue ) );
			$span->setAttribute( 'class', 'label' );
			$strong->parentNode->replaceChild( $span, $strong );
		}
	} );

	// remove p tags but keep the content inside
	$crawler->filter( '.wc-item-meta p' )->each( function ( Crawler $crawler, int $i ): void {
		foreach ( $crawler as $p ) {
			while ( $p->firstChild ) {
				$p->parentNode->insertBefore( $p->firstChild, $p );
			}
			$p->parentNode->removeChild( $p );
		}
	} );

	// replace ul.wc-item-meta with div and wrap each li content in a p
	$crawler->filter( 'ul.wc-item-meta' )->each( function ( Crawler $crawler, int $i ): void {
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
/**
 * Output footer positioning overrides for the supported templates.
 *
 * @param string      $document_type Document type slug.
 * @param object|null $document      Document being rendered.
 * @return void
 */
function wpo_wcpdf_mpdf_premium_style_overrides( string $document_type, ?object $document = null ): void {
	$core          = WPO_WCPDF();
	$settings      = is_callable( array( $core, 'get_instance' ) ) ? $core->get_instance( 'settings' ) : $core->settings;
	$template_name = basename( $settings->get_template_path() );
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
add_filter( 'woocommerce_get_plugins_for_woocommerce', function( array $matches, array $plugins ): array {
	foreach ( $matches as $basename => $plugin_data ) {
		if ( $basename == plugin_basename( __FILE__ ) ) {
			unset( $matches[ $basename ] );
		}
	}
	return $matches;
}, 10, 2 );

// add RTL support option to general settings
add_filter( 'wpo_wcpdf_settings_fields_general', 'wpo_wcpdf_mpdf_rtl_support', 10, 4 );
/**
 * Add the RTL layout option to the core plugin's general settings.
 *
 * @param array  $settings_fields Registered settings fields.
 * @param string $page            Settings page identifier.
 * @param string $option_group    Settings option group.
 * @param string $option_name     Settings option name.
 * @return array Settings fields including the RTL option.
 */
function wpo_wcpdf_mpdf_rtl_support( array $settings_fields, string $page, string $option_group, string $option_name ): array {
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
/**
 * Wrap document content with mPDF and optional RTL layout classes.
 *
 * @param string $content Document content HTML.
 * @return string Wrapped document content.
 */
function wpo_wcpdf_mpdf_wrap_html_content( string $content ): string {
	$general_settings = wpo_wcpdf_mpdf_get_settings( 'general' );
	$classes          ='mpdf';

	if ( ! empty( $general_settings['rtl_support'] ) ) {
		$classes .= ' rtl';
	}

	$content = '<div class="'.$classes.'">'.$content.'</div>';

	return $content;
}

/**
 * Read core's loaded settings, retaining compatibility with older core releases.
 *
 * @param string $type Settings group: general or debug.
 * @return array
 * @throws \InvalidArgumentException When the settings group is unsupported.
 */
function wpo_wcpdf_mpdf_get_settings( string $type ): array {
	if ( ! in_array( $type, array( 'general', 'debug' ), true ) ) {
		throw new \InvalidArgumentException( 'Unknown mPDF settings group.' );
	}
	$core     = WPO_WCPDF();
	$settings = is_callable( array( $core, 'get_instance' ) ) ? $core->get_instance( 'settings' ) : $core->settings;
	if ( is_callable( array( $settings, 'get_settings' ) ) ) {
		return $settings->get_settings( $type );
	}
	$value = $settings->{ $type . '_settings' } ?? get_option( 'wpo_wcpdf_settings_' . $type, array() );
	return is_array( $value ) ? $value : array();
}
