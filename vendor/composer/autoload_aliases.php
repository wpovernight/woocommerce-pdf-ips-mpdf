<?php

// Functions and constants

namespace {

}
namespace Mpdf {
    if(!function_exists('\\Mpdf\\unicode_hex')){
        function unicode_hex(...$args) {
            return \WPO\IPS\Mpdf\Vendor\Mpdf\unicode_hex(...func_get_args());
        }
    }
}
namespace DeepCopy {
    if(!function_exists('\\DeepCopy\\deep_copy')){
        function deep_copy(...$args) {
            return \WPO\IPS\Mpdf\Vendor\DeepCopy\deep_copy(...func_get_args());
        }
    }
}


namespace WPO\IPS\Mpdf\Vendor {

    use BrianHenryIE\Strauss\Types\AutoloadAliasInterface;

    /**
     * @see AutoloadAliasInterface
     *
     * @phpstan-type ClassAliasArray array{'type':'class',isabstract:bool,classname:string,namespace?:string,extends:string,implements:array<string>}
     * @phpstan-type InterfaceAliasArray array{'type':'interface',interfacename:string,namespace?:string,extends:array<string>}
     * @phpstan-type TraitAliasArray array{'type':'trait',traitname:string,namespace?:string,use:array<string>}
     * @phpstan-type AutoloadAliasArray array<string,ClassAliasArray|InterfaceAliasArray|TraitAliasArray>
     */
    class AliasAutoloader
    {
        private string $includeFilePath;

        /**
         * @var AutoloadAliasArray
         */
        private array $autoloadAliases = array (
  'Mpdf\\AssetFetcher' => 
  array (
    'type' => 'class',
    'classname' => 'AssetFetcher',
    'isabstract' => false,
    'namespace' => 'Mpdf',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\AssetFetcher',
    'implements' => 
    array (
      0 => 'Psr\\Log\\LoggerAwareInterface',
    ),
  ),
  'Mpdf\\Barcode\\AbstractBarcode' => 
  array (
    'type' => 'class',
    'classname' => 'AbstractBarcode',
    'isabstract' => true,
    'namespace' => 'Mpdf\\Barcode',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Barcode\\AbstractBarcode',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Barcode\\BarcodeException' => 
  array (
    'type' => 'class',
    'classname' => 'BarcodeException',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Barcode',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Barcode\\BarcodeException',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Barcode\\Codabar' => 
  array (
    'type' => 'class',
    'classname' => 'Codabar',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Barcode',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Barcode\\Codabar',
    'implements' => 
    array (
      0 => 'Mpdf\\Barcode\\BarcodeInterface',
    ),
  ),
  'Mpdf\\Barcode\\Code11' => 
  array (
    'type' => 'class',
    'classname' => 'Code11',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Barcode',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Barcode\\Code11',
    'implements' => 
    array (
      0 => 'Mpdf\\Barcode\\BarcodeInterface',
    ),
  ),
  'Mpdf\\Barcode\\Code128' => 
  array (
    'type' => 'class',
    'classname' => 'Code128',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Barcode',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Barcode\\Code128',
    'implements' => 
    array (
      0 => 'Mpdf\\Barcode\\BarcodeInterface',
    ),
  ),
  'Mpdf\\Barcode\\Code39' => 
  array (
    'type' => 'class',
    'classname' => 'Code39',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Barcode',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Barcode\\Code39',
    'implements' => 
    array (
      0 => 'Mpdf\\Barcode\\BarcodeInterface',
    ),
  ),
  'Mpdf\\Barcode\\Code93' => 
  array (
    'type' => 'class',
    'classname' => 'Code93',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Barcode',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Barcode\\Code93',
    'implements' => 
    array (
      0 => 'Mpdf\\Barcode\\BarcodeInterface',
    ),
  ),
  'Mpdf\\Barcode\\EanExt' => 
  array (
    'type' => 'class',
    'classname' => 'EanExt',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Barcode',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Barcode\\EanExt',
    'implements' => 
    array (
      0 => 'Mpdf\\Barcode\\BarcodeInterface',
    ),
  ),
  'Mpdf\\Barcode\\EanUpc' => 
  array (
    'type' => 'class',
    'classname' => 'EanUpc',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Barcode',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Barcode\\EanUpc',
    'implements' => 
    array (
      0 => 'Mpdf\\Barcode\\BarcodeInterface',
    ),
  ),
  'Mpdf\\Barcode\\I25' => 
  array (
    'type' => 'class',
    'classname' => 'I25',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Barcode',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Barcode\\I25',
    'implements' => 
    array (
      0 => 'Mpdf\\Barcode\\BarcodeInterface',
    ),
  ),
  'Mpdf\\Barcode\\Imb' => 
  array (
    'type' => 'class',
    'classname' => 'Imb',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Barcode',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Barcode\\Imb',
    'implements' => 
    array (
      0 => 'Mpdf\\Barcode\\BarcodeInterface',
    ),
  ),
  'Mpdf\\Barcode\\Msi' => 
  array (
    'type' => 'class',
    'classname' => 'Msi',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Barcode',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Barcode\\Msi',
    'implements' => 
    array (
      0 => 'Mpdf\\Barcode\\BarcodeInterface',
    ),
  ),
  'Mpdf\\Barcode\\Postnet' => 
  array (
    'type' => 'class',
    'classname' => 'Postnet',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Barcode',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Barcode\\Postnet',
    'implements' => 
    array (
      0 => 'Mpdf\\Barcode\\BarcodeInterface',
    ),
  ),
  'Mpdf\\Barcode\\Rm4Scc' => 
  array (
    'type' => 'class',
    'classname' => 'Rm4Scc',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Barcode',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Barcode\\Rm4Scc',
    'implements' => 
    array (
      0 => 'Mpdf\\Barcode\\BarcodeInterface',
    ),
  ),
  'Mpdf\\Barcode\\S25' => 
  array (
    'type' => 'class',
    'classname' => 'S25',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Barcode',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Barcode\\S25',
    'implements' => 
    array (
      0 => 'Mpdf\\Barcode\\BarcodeInterface',
    ),
  ),
  'Mpdf\\Cache' => 
  array (
    'type' => 'class',
    'classname' => 'Cache',
    'isabstract' => false,
    'namespace' => 'Mpdf',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Cache',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Color\\ColorConverter' => 
  array (
    'type' => 'class',
    'classname' => 'ColorConverter',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Color',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Color\\ColorConverter',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Color\\ColorModeConverter' => 
  array (
    'type' => 'class',
    'classname' => 'ColorModeConverter',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Color',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Color\\ColorModeConverter',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Color\\ColorSpaceRestrictor' => 
  array (
    'type' => 'class',
    'classname' => 'ColorSpaceRestrictor',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Color',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Color\\ColorSpaceRestrictor',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Color\\NamedColors' => 
  array (
    'type' => 'class',
    'classname' => 'NamedColors',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Color',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Color\\NamedColors',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Config\\ConfigVariables' => 
  array (
    'type' => 'class',
    'classname' => 'ConfigVariables',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Config',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Config\\ConfigVariables',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Config\\FontVariables' => 
  array (
    'type' => 'class',
    'classname' => 'FontVariables',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Config',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Config\\FontVariables',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Container\\NotFoundException' => 
  array (
    'type' => 'class',
    'classname' => 'NotFoundException',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Container',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Container\\NotFoundException',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Container\\SimpleContainer' => 
  array (
    'type' => 'class',
    'classname' => 'SimpleContainer',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Container',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Container\\SimpleContainer',
    'implements' => 
    array (
      0 => 'Mpdf\\Container\\ContainerInterface',
    ),
  ),
  'Mpdf\\Conversion\\DecToAlpha' => 
  array (
    'type' => 'class',
    'classname' => 'DecToAlpha',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Conversion',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Conversion\\DecToAlpha',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Conversion\\DecToCjk' => 
  array (
    'type' => 'class',
    'classname' => 'DecToCjk',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Conversion',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Conversion\\DecToCjk',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Conversion\\DecToHebrew' => 
  array (
    'type' => 'class',
    'classname' => 'DecToHebrew',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Conversion',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Conversion\\DecToHebrew',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Conversion\\DecToOther' => 
  array (
    'type' => 'class',
    'classname' => 'DecToOther',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Conversion',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Conversion\\DecToOther',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Conversion\\DecToRoman' => 
  array (
    'type' => 'class',
    'classname' => 'DecToRoman',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Conversion',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Conversion\\DecToRoman',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Css\\Border' => 
  array (
    'type' => 'class',
    'classname' => 'Border',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Css',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Css\\Border',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Css\\DefaultCss' => 
  array (
    'type' => 'class',
    'classname' => 'DefaultCss',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Css',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Css\\DefaultCss',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Css\\TextVars' => 
  array (
    'type' => 'class',
    'classname' => 'TextVars',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Css',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Css\\TextVars',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\CssManager' => 
  array (
    'type' => 'class',
    'classname' => 'CssManager',
    'isabstract' => false,
    'namespace' => 'Mpdf',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\CssManager',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\DirectWrite' => 
  array (
    'type' => 'class',
    'classname' => 'DirectWrite',
    'isabstract' => false,
    'namespace' => 'Mpdf',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\DirectWrite',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Exception\\AssetFetchingException' => 
  array (
    'type' => 'class',
    'classname' => 'AssetFetchingException',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Exception',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Exception\\AssetFetchingException',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Exception\\FontException' => 
  array (
    'type' => 'class',
    'classname' => 'FontException',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Exception',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Exception\\FontException',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Exception\\InvalidArgumentException' => 
  array (
    'type' => 'class',
    'classname' => 'InvalidArgumentException',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Exception',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Exception\\InvalidArgumentException',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\File\\LocalContentLoader' => 
  array (
    'type' => 'class',
    'classname' => 'LocalContentLoader',
    'isabstract' => false,
    'namespace' => 'Mpdf\\File',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\File\\LocalContentLoader',
    'implements' => 
    array (
      0 => 'Mpdf\\File\\LocalContentLoaderInterface',
    ),
  ),
  'Mpdf\\File\\StreamWrapperChecker' => 
  array (
    'type' => 'class',
    'classname' => 'StreamWrapperChecker',
    'isabstract' => false,
    'namespace' => 'Mpdf\\File',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\File\\StreamWrapperChecker',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Fonts\\FontCache' => 
  array (
    'type' => 'class',
    'classname' => 'FontCache',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Fonts',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Fonts\\FontCache',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Fonts\\FontFileFinder' => 
  array (
    'type' => 'class',
    'classname' => 'FontFileFinder',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Fonts',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Fonts\\FontFileFinder',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Fonts\\GlyphOperator' => 
  array (
    'type' => 'class',
    'classname' => 'GlyphOperator',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Fonts',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Fonts\\GlyphOperator',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Fonts\\MetricsGenerator' => 
  array (
    'type' => 'class',
    'classname' => 'MetricsGenerator',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Fonts',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Fonts\\MetricsGenerator',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Form' => 
  array (
    'type' => 'class',
    'classname' => 'Form',
    'isabstract' => false,
    'namespace' => 'Mpdf',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Form',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Gif\\ColorTable' => 
  array (
    'type' => 'class',
    'classname' => 'ColorTable',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Gif',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Gif\\ColorTable',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Gif\\FileHeader' => 
  array (
    'type' => 'class',
    'classname' => 'FileHeader',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Gif',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Gif\\FileHeader',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Gif\\Gif' => 
  array (
    'type' => 'class',
    'classname' => 'Gif',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Gif',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Gif\\Gif',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Gif\\Image' => 
  array (
    'type' => 'class',
    'classname' => 'Image',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Gif',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Gif\\Image',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Gif\\ImageHeader' => 
  array (
    'type' => 'class',
    'classname' => 'ImageHeader',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Gif',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Gif\\ImageHeader',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Gif\\Lzw' => 
  array (
    'type' => 'class',
    'classname' => 'Lzw',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Gif',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Gif\\Lzw',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Gradient' => 
  array (
    'type' => 'class',
    'classname' => 'Gradient',
    'isabstract' => false,
    'namespace' => 'Mpdf',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Gradient',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\HTMLParserMode' => 
  array (
    'type' => 'class',
    'classname' => 'HTMLParserMode',
    'isabstract' => false,
    'namespace' => 'Mpdf',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\HTMLParserMode',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Http\\CurlHttpClient' => 
  array (
    'type' => 'class',
    'classname' => 'CurlHttpClient',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Http',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Http\\CurlHttpClient',
    'implements' => 
    array (
      0 => 'Mpdf\\Http\\ClientInterface',
      1 => 'Psr\\Log\\LoggerAwareInterface',
    ),
  ),
  'Mpdf\\Http\\Exception\\ClientException' => 
  array (
    'type' => 'class',
    'classname' => 'ClientException',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Http\\Exception',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Http\\Exception\\ClientException',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Http\\Exception\\ForbiddenRequestException' => 
  array (
    'type' => 'class',
    'classname' => 'ForbiddenRequestException',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Http\\Exception',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Http\\Exception\\ForbiddenRequestException',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Http\\Exception\\NetworkException' => 
  array (
    'type' => 'class',
    'classname' => 'NetworkException',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Http\\Exception',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Http\\Exception\\NetworkException',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Http\\Exception\\RequestException' => 
  array (
    'type' => 'class',
    'classname' => 'RequestException',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Http\\Exception',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Http\\Exception\\RequestException',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Http\\SocketHttpClient' => 
  array (
    'type' => 'class',
    'classname' => 'SocketHttpClient',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Http',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Http\\SocketHttpClient',
    'implements' => 
    array (
      0 => 'Mpdf\\Http\\ClientInterface',
      1 => 'Psr\\Log\\LoggerAwareInterface',
    ),
  ),
  'Mpdf\\Hyphenator' => 
  array (
    'type' => 'class',
    'classname' => 'Hyphenator',
    'isabstract' => false,
    'namespace' => 'Mpdf',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Hyphenator',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Image\\Bmp' => 
  array (
    'type' => 'class',
    'classname' => 'Bmp',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Image',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Image\\Bmp',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Image\\ImageProcessor' => 
  array (
    'type' => 'class',
    'classname' => 'ImageProcessor',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Image',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Image\\ImageProcessor',
    'implements' => 
    array (
      0 => 'Psr\\Log\\LoggerAwareInterface',
    ),
  ),
  'Mpdf\\Image\\ImageTypeGuesser' => 
  array (
    'type' => 'class',
    'classname' => 'ImageTypeGuesser',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Image',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Image\\ImageTypeGuesser',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Image\\Svg' => 
  array (
    'type' => 'class',
    'classname' => 'Svg',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Image',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Image\\Svg',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Image\\Wmf' => 
  array (
    'type' => 'class',
    'classname' => 'Wmf',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Image',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Image\\Wmf',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Language\\LanguageToFont' => 
  array (
    'type' => 'class',
    'classname' => 'LanguageToFont',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Language',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Language\\LanguageToFont',
    'implements' => 
    array (
      0 => 'Mpdf\\Language\\LanguageToFontInterface',
    ),
  ),
  'Mpdf\\Language\\ScriptToLanguage' => 
  array (
    'type' => 'class',
    'classname' => 'ScriptToLanguage',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Language',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Language\\ScriptToLanguage',
    'implements' => 
    array (
      0 => 'Mpdf\\Language\\ScriptToLanguageInterface',
    ),
  ),
  'Mpdf\\Log\\Context' => 
  array (
    'type' => 'class',
    'classname' => 'Context',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Log',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Log\\Context',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Mpdf' => 
  array (
    'type' => 'class',
    'classname' => 'Mpdf',
    'isabstract' => false,
    'namespace' => 'Mpdf',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Mpdf',
    'implements' => 
    array (
      0 => 'Psr\\Log\\LoggerAwareInterface',
    ),
  ),
  'Mpdf\\MpdfException' => 
  array (
    'type' => 'class',
    'classname' => 'MpdfException',
    'isabstract' => false,
    'namespace' => 'Mpdf',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\MpdfException',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\MpdfImageException' => 
  array (
    'type' => 'class',
    'classname' => 'MpdfImageException',
    'isabstract' => false,
    'namespace' => 'Mpdf',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\MpdfImageException',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Otl' => 
  array (
    'type' => 'class',
    'classname' => 'Otl',
    'isabstract' => false,
    'namespace' => 'Mpdf',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Otl',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\OtlDump' => 
  array (
    'type' => 'class',
    'classname' => 'OtlDump',
    'isabstract' => false,
    'namespace' => 'Mpdf',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\OtlDump',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Output\\Destination' => 
  array (
    'type' => 'class',
    'classname' => 'Destination',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Output',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Output\\Destination',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\PageBox' => 
  array (
    'type' => 'class',
    'classname' => 'PageBox',
    'isabstract' => false,
    'namespace' => 'Mpdf',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\PageBox',
    'implements' => 
    array (
      0 => 'ArrayAccess',
    ),
  ),
  'Mpdf\\PageFormat' => 
  array (
    'type' => 'class',
    'classname' => 'PageFormat',
    'isabstract' => false,
    'namespace' => 'Mpdf',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\PageFormat',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Pdf\\Protection\\UniqidGenerator' => 
  array (
    'type' => 'class',
    'classname' => 'UniqidGenerator',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Pdf\\Protection',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Pdf\\Protection\\UniqidGenerator',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\ServiceFactory' => 
  array (
    'type' => 'class',
    'classname' => 'ServiceFactory',
    'isabstract' => false,
    'namespace' => 'Mpdf',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\ServiceFactory',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Shaper\\Indic' => 
  array (
    'type' => 'class',
    'classname' => 'Indic',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Shaper',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Shaper\\Indic',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Shaper\\Myanmar' => 
  array (
    'type' => 'class',
    'classname' => 'Myanmar',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Shaper',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Shaper\\Myanmar',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Shaper\\Sea' => 
  array (
    'type' => 'class',
    'classname' => 'Sea',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Shaper',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Shaper\\Sea',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\SizeConverter' => 
  array (
    'type' => 'class',
    'classname' => 'SizeConverter',
    'isabstract' => false,
    'namespace' => 'Mpdf',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\SizeConverter',
    'implements' => 
    array (
      0 => 'Psr\\Log\\LoggerAwareInterface',
    ),
  ),
  'Mpdf\\TTFontFile' => 
  array (
    'type' => 'class',
    'classname' => 'TTFontFile',
    'isabstract' => false,
    'namespace' => 'Mpdf',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\TTFontFile',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\TTFontFileAnalysis' => 
  array (
    'type' => 'class',
    'classname' => 'TTFontFileAnalysis',
    'isabstract' => false,
    'namespace' => 'Mpdf',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\TTFontFileAnalysis',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\TableOfContents' => 
  array (
    'type' => 'class',
    'classname' => 'TableOfContents',
    'isabstract' => false,
    'namespace' => 'Mpdf',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\TableOfContents',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\A' => 
  array (
    'type' => 'class',
    'classname' => 'A',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\A',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Acronym' => 
  array (
    'type' => 'class',
    'classname' => 'Acronym',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Acronym',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Address' => 
  array (
    'type' => 'class',
    'classname' => 'Address',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Address',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Annotation' => 
  array (
    'type' => 'class',
    'classname' => 'Annotation',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Annotation',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Article' => 
  array (
    'type' => 'class',
    'classname' => 'Article',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Article',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Aside' => 
  array (
    'type' => 'class',
    'classname' => 'Aside',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Aside',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\B' => 
  array (
    'type' => 'class',
    'classname' => 'B',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\B',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\BarCode' => 
  array (
    'type' => 'class',
    'classname' => 'BarCode',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\BarCode',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Bdi' => 
  array (
    'type' => 'class',
    'classname' => 'Bdi',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Bdi',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Bdo' => 
  array (
    'type' => 'class',
    'classname' => 'Bdo',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Bdo',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Big' => 
  array (
    'type' => 'class',
    'classname' => 'Big',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Big',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\BlockQuote' => 
  array (
    'type' => 'class',
    'classname' => 'BlockQuote',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\BlockQuote',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\BlockTag' => 
  array (
    'type' => 'class',
    'classname' => 'BlockTag',
    'isabstract' => true,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\BlockTag',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Bookmark' => 
  array (
    'type' => 'class',
    'classname' => 'Bookmark',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Bookmark',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Br' => 
  array (
    'type' => 'class',
    'classname' => 'Br',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Br',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Caption' => 
  array (
    'type' => 'class',
    'classname' => 'Caption',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Caption',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Center' => 
  array (
    'type' => 'class',
    'classname' => 'Center',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Center',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Cite' => 
  array (
    'type' => 'class',
    'classname' => 'Cite',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Cite',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Code' => 
  array (
    'type' => 'class',
    'classname' => 'Code',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Code',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\ColumnBreak' => 
  array (
    'type' => 'class',
    'classname' => 'ColumnBreak',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\ColumnBreak',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Columns' => 
  array (
    'type' => 'class',
    'classname' => 'Columns',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Columns',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Dd' => 
  array (
    'type' => 'class',
    'classname' => 'Dd',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Dd',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Del' => 
  array (
    'type' => 'class',
    'classname' => 'Del',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Del',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Details' => 
  array (
    'type' => 'class',
    'classname' => 'Details',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Details',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Div' => 
  array (
    'type' => 'class',
    'classname' => 'Div',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Div',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Dl' => 
  array (
    'type' => 'class',
    'classname' => 'Dl',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Dl',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\DotTab' => 
  array (
    'type' => 'class',
    'classname' => 'DotTab',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\DotTab',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Dt' => 
  array (
    'type' => 'class',
    'classname' => 'Dt',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Dt',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Em' => 
  array (
    'type' => 'class',
    'classname' => 'Em',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Em',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\FieldSet' => 
  array (
    'type' => 'class',
    'classname' => 'FieldSet',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\FieldSet',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\FigCaption' => 
  array (
    'type' => 'class',
    'classname' => 'FigCaption',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\FigCaption',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Figure' => 
  array (
    'type' => 'class',
    'classname' => 'Figure',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Figure',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Font' => 
  array (
    'type' => 'class',
    'classname' => 'Font',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Font',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Footer' => 
  array (
    'type' => 'class',
    'classname' => 'Footer',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Footer',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Form' => 
  array (
    'type' => 'class',
    'classname' => 'Form',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Form',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\FormFeed' => 
  array (
    'type' => 'class',
    'classname' => 'FormFeed',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\FormFeed',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\H1' => 
  array (
    'type' => 'class',
    'classname' => 'H1',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\H1',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\H2' => 
  array (
    'type' => 'class',
    'classname' => 'H2',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\H2',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\H3' => 
  array (
    'type' => 'class',
    'classname' => 'H3',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\H3',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\H4' => 
  array (
    'type' => 'class',
    'classname' => 'H4',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\H4',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\H5' => 
  array (
    'type' => 'class',
    'classname' => 'H5',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\H5',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\H6' => 
  array (
    'type' => 'class',
    'classname' => 'H6',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\H6',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\HGroup' => 
  array (
    'type' => 'class',
    'classname' => 'HGroup',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\HGroup',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Header' => 
  array (
    'type' => 'class',
    'classname' => 'Header',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Header',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Hr' => 
  array (
    'type' => 'class',
    'classname' => 'Hr',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Hr',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\I' => 
  array (
    'type' => 'class',
    'classname' => 'I',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\I',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Img' => 
  array (
    'type' => 'class',
    'classname' => 'Img',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Img',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\IndexEntry' => 
  array (
    'type' => 'class',
    'classname' => 'IndexEntry',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\IndexEntry',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\IndexInsert' => 
  array (
    'type' => 'class',
    'classname' => 'IndexInsert',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\IndexInsert',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\InlineTag' => 
  array (
    'type' => 'class',
    'classname' => 'InlineTag',
    'isabstract' => true,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\InlineTag',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Input' => 
  array (
    'type' => 'class',
    'classname' => 'Input',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Input',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Ins' => 
  array (
    'type' => 'class',
    'classname' => 'Ins',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Ins',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Kbd' => 
  array (
    'type' => 'class',
    'classname' => 'Kbd',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Kbd',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Legend' => 
  array (
    'type' => 'class',
    'classname' => 'Legend',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Legend',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Li' => 
  array (
    'type' => 'class',
    'classname' => 'Li',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Li',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Main' => 
  array (
    'type' => 'class',
    'classname' => 'Main',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Main',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Mark' => 
  array (
    'type' => 'class',
    'classname' => 'Mark',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Mark',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Meter' => 
  array (
    'type' => 'class',
    'classname' => 'Meter',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Meter',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Nav' => 
  array (
    'type' => 'class',
    'classname' => 'Nav',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Nav',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\NewColumn' => 
  array (
    'type' => 'class',
    'classname' => 'NewColumn',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\NewColumn',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\NewPage' => 
  array (
    'type' => 'class',
    'classname' => 'NewPage',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\NewPage',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Ol' => 
  array (
    'type' => 'class',
    'classname' => 'Ol',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Ol',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Option' => 
  array (
    'type' => 'class',
    'classname' => 'Option',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Option',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\P' => 
  array (
    'type' => 'class',
    'classname' => 'P',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\P',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\PageBreak' => 
  array (
    'type' => 'class',
    'classname' => 'PageBreak',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\PageBreak',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\PageFooter' => 
  array (
    'type' => 'class',
    'classname' => 'PageFooter',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\PageFooter',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\PageHeader' => 
  array (
    'type' => 'class',
    'classname' => 'PageHeader',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\PageHeader',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Pre' => 
  array (
    'type' => 'class',
    'classname' => 'Pre',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Pre',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Progress' => 
  array (
    'type' => 'class',
    'classname' => 'Progress',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Progress',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Q' => 
  array (
    'type' => 'class',
    'classname' => 'Q',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Q',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\S' => 
  array (
    'type' => 'class',
    'classname' => 'S',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\S',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Samp' => 
  array (
    'type' => 'class',
    'classname' => 'Samp',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Samp',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Section' => 
  array (
    'type' => 'class',
    'classname' => 'Section',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Section',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Select' => 
  array (
    'type' => 'class',
    'classname' => 'Select',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Select',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\SetHtmlPageFooter' => 
  array (
    'type' => 'class',
    'classname' => 'SetHtmlPageFooter',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\SetHtmlPageFooter',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\SetHtmlPageHeader' => 
  array (
    'type' => 'class',
    'classname' => 'SetHtmlPageHeader',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\SetHtmlPageHeader',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\SetPageFooter' => 
  array (
    'type' => 'class',
    'classname' => 'SetPageFooter',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\SetPageFooter',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\SetPageHeader' => 
  array (
    'type' => 'class',
    'classname' => 'SetPageHeader',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\SetPageHeader',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Small' => 
  array (
    'type' => 'class',
    'classname' => 'Small',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Small',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Span' => 
  array (
    'type' => 'class',
    'classname' => 'Span',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Span',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Strike' => 
  array (
    'type' => 'class',
    'classname' => 'Strike',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Strike',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Strong' => 
  array (
    'type' => 'class',
    'classname' => 'Strong',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Strong',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Sub' => 
  array (
    'type' => 'class',
    'classname' => 'Sub',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Sub',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\SubstituteTag' => 
  array (
    'type' => 'class',
    'classname' => 'SubstituteTag',
    'isabstract' => true,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\SubstituteTag',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Summary' => 
  array (
    'type' => 'class',
    'classname' => 'Summary',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Summary',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Sup' => 
  array (
    'type' => 'class',
    'classname' => 'Sup',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Sup',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\TBody' => 
  array (
    'type' => 'class',
    'classname' => 'TBody',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\TBody',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\TFoot' => 
  array (
    'type' => 'class',
    'classname' => 'TFoot',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\TFoot',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\THead' => 
  array (
    'type' => 'class',
    'classname' => 'THead',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\THead',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Table' => 
  array (
    'type' => 'class',
    'classname' => 'Table',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Table',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Tag' => 
  array (
    'type' => 'class',
    'classname' => 'Tag',
    'isabstract' => true,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Tag',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Td' => 
  array (
    'type' => 'class',
    'classname' => 'Td',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Td',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\TextArea' => 
  array (
    'type' => 'class',
    'classname' => 'TextArea',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\TextArea',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\TextCircle' => 
  array (
    'type' => 'class',
    'classname' => 'TextCircle',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\TextCircle',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Th' => 
  array (
    'type' => 'class',
    'classname' => 'Th',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Th',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Time' => 
  array (
    'type' => 'class',
    'classname' => 'Time',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Time',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Toc' => 
  array (
    'type' => 'class',
    'classname' => 'Toc',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Toc',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\TocEntry' => 
  array (
    'type' => 'class',
    'classname' => 'TocEntry',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\TocEntry',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\TocPageBreak' => 
  array (
    'type' => 'class',
    'classname' => 'TocPageBreak',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\TocPageBreak',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Tr' => 
  array (
    'type' => 'class',
    'classname' => 'Tr',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Tr',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Tt' => 
  array (
    'type' => 'class',
    'classname' => 'Tt',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Tt',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Tta' => 
  array (
    'type' => 'class',
    'classname' => 'Tta',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Tta',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Tts' => 
  array (
    'type' => 'class',
    'classname' => 'Tts',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Tts',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Ttz' => 
  array (
    'type' => 'class',
    'classname' => 'Ttz',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Ttz',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\U' => 
  array (
    'type' => 'class',
    'classname' => 'U',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\U',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\Ul' => 
  array (
    'type' => 'class',
    'classname' => 'Ul',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\Ul',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\VarTag' => 
  array (
    'type' => 'class',
    'classname' => 'VarTag',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\VarTag',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\WatermarkImage' => 
  array (
    'type' => 'class',
    'classname' => 'WatermarkImage',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\WatermarkImage',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Tag\\WatermarkText' => 
  array (
    'type' => 'class',
    'classname' => 'WatermarkText',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Tag',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Tag\\WatermarkText',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Ucdn' => 
  array (
    'type' => 'class',
    'classname' => 'Ucdn',
    'isabstract' => false,
    'namespace' => 'Mpdf',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Ucdn',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Utils\\Arrays' => 
  array (
    'type' => 'class',
    'classname' => 'Arrays',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Utils',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Utils\\Arrays',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Utils\\NumericString' => 
  array (
    'type' => 'class',
    'classname' => 'NumericString',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Utils',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Utils\\NumericString',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Utils\\PdfDate' => 
  array (
    'type' => 'class',
    'classname' => 'PdfDate',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Utils',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Utils\\PdfDate',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Utils\\UtfString' => 
  array (
    'type' => 'class',
    'classname' => 'UtfString',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Utils',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Utils\\UtfString',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\WatermarkImage' => 
  array (
    'type' => 'class',
    'classname' => 'WatermarkImage',
    'isabstract' => false,
    'namespace' => 'Mpdf',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\WatermarkImage',
    'implements' => 
    array (
      0 => 'Mpdf\\Watermark',
    ),
  ),
  'Mpdf\\WatermarkText' => 
  array (
    'type' => 'class',
    'classname' => 'WatermarkText',
    'isabstract' => false,
    'namespace' => 'Mpdf',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\WatermarkText',
    'implements' => 
    array (
      0 => 'Mpdf\\Watermark',
    ),
  ),
  'Mpdf\\Writer\\BackgroundWriter' => 
  array (
    'type' => 'class',
    'classname' => 'BackgroundWriter',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Writer',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Writer\\BackgroundWriter',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Writer\\BaseWriter' => 
  array (
    'type' => 'class',
    'classname' => 'BaseWriter',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Writer',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Writer\\BaseWriter',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Writer\\BookmarkWriter' => 
  array (
    'type' => 'class',
    'classname' => 'BookmarkWriter',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Writer',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Writer\\BookmarkWriter',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Writer\\ColorWriter' => 
  array (
    'type' => 'class',
    'classname' => 'ColorWriter',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Writer',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Writer\\ColorWriter',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Writer\\FontWriter' => 
  array (
    'type' => 'class',
    'classname' => 'FontWriter',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Writer',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Writer\\FontWriter',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Writer\\FormWriter' => 
  array (
    'type' => 'class',
    'classname' => 'FormWriter',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Writer',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Writer\\FormWriter',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Writer\\ImageWriter' => 
  array (
    'type' => 'class',
    'classname' => 'ImageWriter',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Writer',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Writer\\ImageWriter',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Writer\\JavaScriptWriter' => 
  array (
    'type' => 'class',
    'classname' => 'JavaScriptWriter',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Writer',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Writer\\JavaScriptWriter',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Writer\\MetadataWriter' => 
  array (
    'type' => 'class',
    'classname' => 'MetadataWriter',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Writer',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Writer\\MetadataWriter',
    'implements' => 
    array (
      0 => 'Psr\\Log\\LoggerAwareInterface',
    ),
  ),
  'Mpdf\\Writer\\ObjectWriter' => 
  array (
    'type' => 'class',
    'classname' => 'ObjectWriter',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Writer',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Writer\\ObjectWriter',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Writer\\OptionalContentWriter' => 
  array (
    'type' => 'class',
    'classname' => 'OptionalContentWriter',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Writer',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Writer\\OptionalContentWriter',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Writer\\PageWriter' => 
  array (
    'type' => 'class',
    'classname' => 'PageWriter',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Writer',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Writer\\PageWriter',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\Writer\\ResourceWriter' => 
  array (
    'type' => 'class',
    'classname' => 'ResourceWriter',
    'isabstract' => false,
    'namespace' => 'Mpdf\\Writer',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Writer\\ResourceWriter',
    'implements' => 
    array (
      0 => 'Psr\\Log\\LoggerAwareInterface',
    ),
  ),
  'Mpdf\\PsrHttpMessageShim\\Request' => 
  array (
    'type' => 'class',
    'classname' => 'Request',
    'isabstract' => false,
    'namespace' => 'Mpdf\\PsrHttpMessageShim',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\PsrHttpMessageShim\\Request',
    'implements' => 
    array (
      0 => 'Psr\\Http\\Message\\RequestInterface',
    ),
  ),
  'Mpdf\\PsrHttpMessageShim\\Response' => 
  array (
    'type' => 'class',
    'classname' => 'Response',
    'isabstract' => false,
    'namespace' => 'Mpdf\\PsrHttpMessageShim',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\PsrHttpMessageShim\\Response',
    'implements' => 
    array (
      0 => 'Psr\\Http\\Message\\ResponseInterface',
    ),
  ),
  'Mpdf\\PsrHttpMessageShim\\Stream' => 
  array (
    'type' => 'class',
    'classname' => 'Stream',
    'isabstract' => false,
    'namespace' => 'Mpdf\\PsrHttpMessageShim',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\PsrHttpMessageShim\\Stream',
    'implements' => 
    array (
      0 => 'Psr\\Http\\Message\\StreamInterface',
    ),
  ),
  'Mpdf\\PsrHttpMessageShim\\Uri' => 
  array (
    'type' => 'class',
    'classname' => 'Uri',
    'isabstract' => false,
    'namespace' => 'Mpdf\\PsrHttpMessageShim',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\PsrHttpMessageShim\\Uri',
    'implements' => 
    array (
      0 => 'Psr\\Http\\Message\\UriInterface',
    ),
  ),
  'DeepCopy\\DeepCopy' => 
  array (
    'type' => 'class',
    'classname' => 'DeepCopy',
    'isabstract' => false,
    'namespace' => 'DeepCopy',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\DeepCopy\\DeepCopy',
    'implements' => 
    array (
    ),
  ),
  'DeepCopy\\Exception\\CloneException' => 
  array (
    'type' => 'class',
    'classname' => 'CloneException',
    'isabstract' => false,
    'namespace' => 'DeepCopy\\Exception',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\DeepCopy\\Exception\\CloneException',
    'implements' => 
    array (
    ),
  ),
  'DeepCopy\\Exception\\PropertyException' => 
  array (
    'type' => 'class',
    'classname' => 'PropertyException',
    'isabstract' => false,
    'namespace' => 'DeepCopy\\Exception',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\DeepCopy\\Exception\\PropertyException',
    'implements' => 
    array (
    ),
  ),
  'DeepCopy\\Filter\\ChainableFilter' => 
  array (
    'type' => 'class',
    'classname' => 'ChainableFilter',
    'isabstract' => false,
    'namespace' => 'DeepCopy\\Filter',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\DeepCopy\\Filter\\ChainableFilter',
    'implements' => 
    array (
      0 => 'DeepCopy\\Filter\\Filter',
    ),
  ),
  'DeepCopy\\Filter\\Doctrine\\DoctrineCollectionFilter' => 
  array (
    'type' => 'class',
    'classname' => 'DoctrineCollectionFilter',
    'isabstract' => false,
    'namespace' => 'DeepCopy\\Filter\\Doctrine',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\DeepCopy\\Filter\\Doctrine\\DoctrineCollectionFilter',
    'implements' => 
    array (
      0 => 'DeepCopy\\Filter\\Filter',
    ),
  ),
  'DeepCopy\\Filter\\Doctrine\\DoctrineEmptyCollectionFilter' => 
  array (
    'type' => 'class',
    'classname' => 'DoctrineEmptyCollectionFilter',
    'isabstract' => false,
    'namespace' => 'DeepCopy\\Filter\\Doctrine',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\DeepCopy\\Filter\\Doctrine\\DoctrineEmptyCollectionFilter',
    'implements' => 
    array (
      0 => 'DeepCopy\\Filter\\Filter',
    ),
  ),
  'DeepCopy\\Filter\\Doctrine\\DoctrineProxyFilter' => 
  array (
    'type' => 'class',
    'classname' => 'DoctrineProxyFilter',
    'isabstract' => false,
    'namespace' => 'DeepCopy\\Filter\\Doctrine',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\DeepCopy\\Filter\\Doctrine\\DoctrineProxyFilter',
    'implements' => 
    array (
      0 => 'DeepCopy\\Filter\\Filter',
    ),
  ),
  'DeepCopy\\Filter\\KeepFilter' => 
  array (
    'type' => 'class',
    'classname' => 'KeepFilter',
    'isabstract' => false,
    'namespace' => 'DeepCopy\\Filter',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\DeepCopy\\Filter\\KeepFilter',
    'implements' => 
    array (
      0 => 'DeepCopy\\Filter\\Filter',
    ),
  ),
  'DeepCopy\\Filter\\ReplaceFilter' => 
  array (
    'type' => 'class',
    'classname' => 'ReplaceFilter',
    'isabstract' => false,
    'namespace' => 'DeepCopy\\Filter',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\DeepCopy\\Filter\\ReplaceFilter',
    'implements' => 
    array (
      0 => 'DeepCopy\\Filter\\Filter',
    ),
  ),
  'DeepCopy\\Filter\\SetNullFilter' => 
  array (
    'type' => 'class',
    'classname' => 'SetNullFilter',
    'isabstract' => false,
    'namespace' => 'DeepCopy\\Filter',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\DeepCopy\\Filter\\SetNullFilter',
    'implements' => 
    array (
      0 => 'DeepCopy\\Filter\\Filter',
    ),
  ),
  'DeepCopy\\Matcher\\Doctrine\\DoctrineProxyMatcher' => 
  array (
    'type' => 'class',
    'classname' => 'DoctrineProxyMatcher',
    'isabstract' => false,
    'namespace' => 'DeepCopy\\Matcher\\Doctrine',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\DeepCopy\\Matcher\\Doctrine\\DoctrineProxyMatcher',
    'implements' => 
    array (
      0 => 'DeepCopy\\Matcher\\Matcher',
    ),
  ),
  'DeepCopy\\Matcher\\PropertyMatcher' => 
  array (
    'type' => 'class',
    'classname' => 'PropertyMatcher',
    'isabstract' => false,
    'namespace' => 'DeepCopy\\Matcher',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\DeepCopy\\Matcher\\PropertyMatcher',
    'implements' => 
    array (
      0 => 'DeepCopy\\Matcher\\Matcher',
    ),
  ),
  'DeepCopy\\Matcher\\PropertyNameMatcher' => 
  array (
    'type' => 'class',
    'classname' => 'PropertyNameMatcher',
    'isabstract' => false,
    'namespace' => 'DeepCopy\\Matcher',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\DeepCopy\\Matcher\\PropertyNameMatcher',
    'implements' => 
    array (
      0 => 'DeepCopy\\Matcher\\Matcher',
    ),
  ),
  'DeepCopy\\Matcher\\PropertyTypeMatcher' => 
  array (
    'type' => 'class',
    'classname' => 'PropertyTypeMatcher',
    'isabstract' => false,
    'namespace' => 'DeepCopy\\Matcher',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\DeepCopy\\Matcher\\PropertyTypeMatcher',
    'implements' => 
    array (
      0 => 'DeepCopy\\Matcher\\Matcher',
    ),
  ),
  'DeepCopy\\Reflection\\ReflectionHelper' => 
  array (
    'type' => 'class',
    'classname' => 'ReflectionHelper',
    'isabstract' => false,
    'namespace' => 'DeepCopy\\Reflection',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\DeepCopy\\Reflection\\ReflectionHelper',
    'implements' => 
    array (
    ),
  ),
  'DeepCopy\\TypeFilter\\Date\\DateIntervalFilter' => 
  array (
    'type' => 'class',
    'classname' => 'DateIntervalFilter',
    'isabstract' => false,
    'namespace' => 'DeepCopy\\TypeFilter\\Date',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\DeepCopy\\TypeFilter\\Date\\DateIntervalFilter',
    'implements' => 
    array (
      0 => 'DeepCopy\\TypeFilter\\TypeFilter',
    ),
  ),
  'DeepCopy\\TypeFilter\\Date\\DatePeriodFilter' => 
  array (
    'type' => 'class',
    'classname' => 'DatePeriodFilter',
    'isabstract' => false,
    'namespace' => 'DeepCopy\\TypeFilter\\Date',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\DeepCopy\\TypeFilter\\Date\\DatePeriodFilter',
    'implements' => 
    array (
      0 => 'DeepCopy\\TypeFilter\\TypeFilter',
    ),
  ),
  'DeepCopy\\TypeFilter\\ReplaceFilter' => 
  array (
    'type' => 'class',
    'classname' => 'ReplaceFilter',
    'isabstract' => false,
    'namespace' => 'DeepCopy\\TypeFilter',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\DeepCopy\\TypeFilter\\ReplaceFilter',
    'implements' => 
    array (
      0 => 'DeepCopy\\TypeFilter\\TypeFilter',
    ),
  ),
  'DeepCopy\\TypeFilter\\ShallowCopyFilter' => 
  array (
    'type' => 'class',
    'classname' => 'ShallowCopyFilter',
    'isabstract' => false,
    'namespace' => 'DeepCopy\\TypeFilter',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\DeepCopy\\TypeFilter\\ShallowCopyFilter',
    'implements' => 
    array (
      0 => 'DeepCopy\\TypeFilter\\TypeFilter',
    ),
  ),
  'DeepCopy\\TypeFilter\\Spl\\ArrayObjectFilter' => 
  array (
    'type' => 'class',
    'classname' => 'ArrayObjectFilter',
    'isabstract' => false,
    'namespace' => 'DeepCopy\\TypeFilter\\Spl',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\DeepCopy\\TypeFilter\\Spl\\ArrayObjectFilter',
    'implements' => 
    array (
      0 => 'DeepCopy\\TypeFilter\\TypeFilter',
    ),
  ),
  'DeepCopy\\TypeFilter\\Spl\\SplDoublyLinkedList' => 
  array (
    'type' => 'class',
    'classname' => 'SplDoublyLinkedList',
    'isabstract' => false,
    'namespace' => 'DeepCopy\\TypeFilter\\Spl',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\DeepCopy\\TypeFilter\\Spl\\SplDoublyLinkedList',
    'implements' => 
    array (
    ),
  ),
  'DeepCopy\\TypeFilter\\Spl\\SplDoublyLinkedListFilter' => 
  array (
    'type' => 'class',
    'classname' => 'SplDoublyLinkedListFilter',
    'isabstract' => false,
    'namespace' => 'DeepCopy\\TypeFilter\\Spl',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\DeepCopy\\TypeFilter\\Spl\\SplDoublyLinkedListFilter',
    'implements' => 
    array (
      0 => 'DeepCopy\\TypeFilter\\TypeFilter',
    ),
  ),
  'DeepCopy\\TypeMatcher\\TypeMatcher' => 
  array (
    'type' => 'class',
    'classname' => 'TypeMatcher',
    'isabstract' => false,
    'namespace' => 'DeepCopy\\TypeMatcher',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\DeepCopy\\TypeMatcher\\TypeMatcher',
    'implements' => 
    array (
    ),
  ),
  'Psr\\Log\\AbstractLogger' => 
  array (
    'type' => 'class',
    'classname' => 'AbstractLogger',
    'isabstract' => true,
    'namespace' => 'Psr\\Log',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Psr\\Log\\AbstractLogger',
    'implements' => 
    array (
      0 => 'Psr\\Log\\LoggerInterface',
    ),
  ),
  'Psr\\Log\\InvalidArgumentException' => 
  array (
    'type' => 'class',
    'classname' => 'InvalidArgumentException',
    'isabstract' => false,
    'namespace' => 'Psr\\Log',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Psr\\Log\\InvalidArgumentException',
    'implements' => 
    array (
    ),
  ),
  'Psr\\Log\\LogLevel' => 
  array (
    'type' => 'class',
    'classname' => 'LogLevel',
    'isabstract' => false,
    'namespace' => 'Psr\\Log',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Psr\\Log\\LogLevel',
    'implements' => 
    array (
    ),
  ),
  'Psr\\Log\\NullLogger' => 
  array (
    'type' => 'class',
    'classname' => 'NullLogger',
    'isabstract' => false,
    'namespace' => 'Psr\\Log',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\Psr\\Log\\NullLogger',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\FpdfTpl' => 
  array (
    'type' => 'class',
    'classname' => 'FpdfTpl',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\FpdfTpl',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\Fpdi' => 
  array (
    'type' => 'class',
    'classname' => 'Fpdi',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\Fpdi',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\FpdiException' => 
  array (
    'type' => 'class',
    'classname' => 'FpdiException',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\FpdiException',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\GraphicsState' => 
  array (
    'type' => 'class',
    'classname' => 'GraphicsState',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\GraphicsState',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\Math\\Matrix' => 
  array (
    'type' => 'class',
    'classname' => 'Matrix',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\Math',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\Math\\Matrix',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\Math\\Vector' => 
  array (
    'type' => 'class',
    'classname' => 'Vector',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\Math',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\Math\\Vector',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\CrossReference\\AbstractReader' => 
  array (
    'type' => 'class',
    'classname' => 'AbstractReader',
    'isabstract' => true,
    'namespace' => 'setasign\\Fpdi\\PdfParser\\CrossReference',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\CrossReference\\AbstractReader',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\CrossReference\\CrossReference' => 
  array (
    'type' => 'class',
    'classname' => 'CrossReference',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser\\CrossReference',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\CrossReference\\CrossReference',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\CrossReference\\CrossReferenceException' => 
  array (
    'type' => 'class',
    'classname' => 'CrossReferenceException',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser\\CrossReference',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\CrossReference\\CrossReferenceException',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\CrossReference\\FixedReader' => 
  array (
    'type' => 'class',
    'classname' => 'FixedReader',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser\\CrossReference',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\CrossReference\\FixedReader',
    'implements' => 
    array (
      0 => 'setasign\\Fpdi\\PdfParser\\CrossReference\\ReaderInterface',
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\CrossReference\\LineReader' => 
  array (
    'type' => 'class',
    'classname' => 'LineReader',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser\\CrossReference',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\CrossReference\\LineReader',
    'implements' => 
    array (
      0 => 'setasign\\Fpdi\\PdfParser\\CrossReference\\ReaderInterface',
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\Filter\\Ascii85' => 
  array (
    'type' => 'class',
    'classname' => 'Ascii85',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser\\Filter',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\Filter\\Ascii85',
    'implements' => 
    array (
      0 => 'setasign\\Fpdi\\PdfParser\\Filter\\FilterInterface',
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\Filter\\Ascii85Exception' => 
  array (
    'type' => 'class',
    'classname' => 'Ascii85Exception',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser\\Filter',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\Filter\\Ascii85Exception',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\Filter\\AsciiHex' => 
  array (
    'type' => 'class',
    'classname' => 'AsciiHex',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser\\Filter',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\Filter\\AsciiHex',
    'implements' => 
    array (
      0 => 'setasign\\Fpdi\\PdfParser\\Filter\\FilterInterface',
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\Filter\\FilterException' => 
  array (
    'type' => 'class',
    'classname' => 'FilterException',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser\\Filter',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\Filter\\FilterException',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\Filter\\Flate' => 
  array (
    'type' => 'class',
    'classname' => 'Flate',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser\\Filter',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\Filter\\Flate',
    'implements' => 
    array (
      0 => 'setasign\\Fpdi\\PdfParser\\Filter\\FilterInterface',
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\Filter\\FlateException' => 
  array (
    'type' => 'class',
    'classname' => 'FlateException',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser\\Filter',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\Filter\\FlateException',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\Filter\\Lzw' => 
  array (
    'type' => 'class',
    'classname' => 'Lzw',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser\\Filter',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\Filter\\Lzw',
    'implements' => 
    array (
      0 => 'setasign\\Fpdi\\PdfParser\\Filter\\FilterInterface',
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\Filter\\LzwException' => 
  array (
    'type' => 'class',
    'classname' => 'LzwException',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser\\Filter',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\Filter\\LzwException',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\PdfParser' => 
  array (
    'type' => 'class',
    'classname' => 'PdfParser',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\PdfParser',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\PdfParserException' => 
  array (
    'type' => 'class',
    'classname' => 'PdfParserException',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\PdfParserException',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\StreamReader' => 
  array (
    'type' => 'class',
    'classname' => 'StreamReader',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\StreamReader',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\Tokenizer' => 
  array (
    'type' => 'class',
    'classname' => 'Tokenizer',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\Tokenizer',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\Type\\PdfArray' => 
  array (
    'type' => 'class',
    'classname' => 'PdfArray',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser\\Type',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\Type\\PdfArray',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\Type\\PdfBoolean' => 
  array (
    'type' => 'class',
    'classname' => 'PdfBoolean',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser\\Type',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\Type\\PdfBoolean',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\Type\\PdfDictionary' => 
  array (
    'type' => 'class',
    'classname' => 'PdfDictionary',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser\\Type',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\Type\\PdfDictionary',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\Type\\PdfHexString' => 
  array (
    'type' => 'class',
    'classname' => 'PdfHexString',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser\\Type',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\Type\\PdfHexString',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\Type\\PdfIndirectObject' => 
  array (
    'type' => 'class',
    'classname' => 'PdfIndirectObject',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser\\Type',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\Type\\PdfIndirectObject',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\Type\\PdfIndirectObjectReference' => 
  array (
    'type' => 'class',
    'classname' => 'PdfIndirectObjectReference',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser\\Type',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\Type\\PdfIndirectObjectReference',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\Type\\PdfName' => 
  array (
    'type' => 'class',
    'classname' => 'PdfName',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser\\Type',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\Type\\PdfName',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\Type\\PdfNull' => 
  array (
    'type' => 'class',
    'classname' => 'PdfNull',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser\\Type',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\Type\\PdfNull',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\Type\\PdfNumeric' => 
  array (
    'type' => 'class',
    'classname' => 'PdfNumeric',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser\\Type',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\Type\\PdfNumeric',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\Type\\PdfStream' => 
  array (
    'type' => 'class',
    'classname' => 'PdfStream',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser\\Type',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\Type\\PdfStream',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\Type\\PdfString' => 
  array (
    'type' => 'class',
    'classname' => 'PdfString',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser\\Type',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\Type\\PdfString',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\Type\\PdfToken' => 
  array (
    'type' => 'class',
    'classname' => 'PdfToken',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser\\Type',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\Type\\PdfToken',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\Type\\PdfType' => 
  array (
    'type' => 'class',
    'classname' => 'PdfType',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser\\Type',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\Type\\PdfType',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\Type\\PdfTypeException' => 
  array (
    'type' => 'class',
    'classname' => 'PdfTypeException',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfParser\\Type',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\Type\\PdfTypeException',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfReader\\DataStructure\\Rectangle' => 
  array (
    'type' => 'class',
    'classname' => 'Rectangle',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfReader\\DataStructure',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfReader\\DataStructure\\Rectangle',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfReader\\Page' => 
  array (
    'type' => 'class',
    'classname' => 'Page',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfReader',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfReader\\Page',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfReader\\PageBoundaries' => 
  array (
    'type' => 'class',
    'classname' => 'PageBoundaries',
    'isabstract' => true,
    'namespace' => 'setasign\\Fpdi\\PdfReader',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfReader\\PageBoundaries',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfReader\\PdfReader' => 
  array (
    'type' => 'class',
    'classname' => 'PdfReader',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfReader',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfReader\\PdfReader',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\PdfReader\\PdfReaderException' => 
  array (
    'type' => 'class',
    'classname' => 'PdfReaderException',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\PdfReader',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfReader\\PdfReaderException',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\Tcpdf\\Fpdi' => 
  array (
    'type' => 'class',
    'classname' => 'Fpdi',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\Tcpdf',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\Tcpdf\\Fpdi',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\TcpdfFpdi' => 
  array (
    'type' => 'class',
    'classname' => 'TcpdfFpdi',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\TcpdfFpdi',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\Tfpdf\\FpdfTpl' => 
  array (
    'type' => 'class',
    'classname' => 'FpdfTpl',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\Tfpdf',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\Tfpdf\\FpdfTpl',
    'implements' => 
    array (
    ),
  ),
  'setasign\\Fpdi\\Tfpdf\\Fpdi' => 
  array (
    'type' => 'class',
    'classname' => 'Fpdi',
    'isabstract' => false,
    'namespace' => 'setasign\\Fpdi\\Tfpdf',
    'extends' => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\Tfpdf\\Fpdi',
    'implements' => 
    array (
    ),
  ),
  'Mpdf\\FpdiTrait' => 
  array (
    'type' => 'trait',
    'traitname' => 'FpdiTrait',
    'namespace' => 'Mpdf',
    'use' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\FpdiTrait',
    ),
  ),
  'Mpdf\\Strict' => 
  array (
    'type' => 'trait',
    'traitname' => 'Strict',
    'namespace' => 'Mpdf',
    'use' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Strict',
    ),
  ),
  'Mpdf\\PsrLogAwareTrait\\MpdfPsrLogAwareTrait' => 
  array (
    'type' => 'trait',
    'traitname' => 'MpdfPsrLogAwareTrait',
    'namespace' => 'Mpdf\\PsrLogAwareTrait',
    'use' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\PsrLogAwareTrait\\MpdfPsrLogAwareTrait',
    ),
  ),
  'Mpdf\\PsrLogAwareTrait\\PsrLogAwareTrait' => 
  array (
    'type' => 'trait',
    'traitname' => 'PsrLogAwareTrait',
    'namespace' => 'Mpdf\\PsrLogAwareTrait',
    'use' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\PsrLogAwareTrait\\PsrLogAwareTrait',
    ),
  ),
  'Psr\\Log\\LoggerAwareTrait' => 
  array (
    'type' => 'trait',
    'traitname' => 'LoggerAwareTrait',
    'namespace' => 'Psr\\Log',
    'use' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\Psr\\Log\\LoggerAwareTrait',
    ),
  ),
  'Psr\\Log\\LoggerTrait' => 
  array (
    'type' => 'trait',
    'traitname' => 'LoggerTrait',
    'namespace' => 'Psr\\Log',
    'use' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\Psr\\Log\\LoggerTrait',
    ),
  ),
  'setasign\\Fpdi\\FpdfTplTrait' => 
  array (
    'type' => 'trait',
    'traitname' => 'FpdfTplTrait',
    'namespace' => 'setasign\\Fpdi',
    'use' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\FpdfTplTrait',
    ),
  ),
  'setasign\\Fpdi\\FpdfTrait' => 
  array (
    'type' => 'trait',
    'traitname' => 'FpdfTrait',
    'namespace' => 'setasign\\Fpdi',
    'use' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\FpdfTrait',
    ),
  ),
  'setasign\\Fpdi\\FpdiTrait' => 
  array (
    'type' => 'trait',
    'traitname' => 'FpdiTrait',
    'namespace' => 'setasign\\Fpdi',
    'use' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\FpdiTrait',
    ),
  ),
  'Mpdf\\Barcode\\BarcodeInterface' => 
  array (
    'type' => 'interface',
    'interfacename' => 'BarcodeInterface',
    'namespace' => 'Mpdf\\Barcode',
    'extends' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Barcode\\BarcodeInterface',
    ),
  ),
  'Mpdf\\Container\\ContainerInterface' => 
  array (
    'type' => 'interface',
    'interfacename' => 'ContainerInterface',
    'namespace' => 'Mpdf\\Container',
    'extends' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Container\\ContainerInterface',
    ),
  ),
  'Mpdf\\File\\LocalContentLoaderInterface' => 
  array (
    'type' => 'interface',
    'interfacename' => 'LocalContentLoaderInterface',
    'namespace' => 'Mpdf\\File',
    'extends' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\File\\LocalContentLoaderInterface',
    ),
  ),
  'Mpdf\\Http\\ClientInterface' => 
  array (
    'type' => 'interface',
    'interfacename' => 'ClientInterface',
    'namespace' => 'Mpdf\\Http',
    'extends' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Http\\ClientInterface',
    ),
  ),
  'Mpdf\\Language\\LanguageToFontInterface' => 
  array (
    'type' => 'interface',
    'interfacename' => 'LanguageToFontInterface',
    'namespace' => 'Mpdf\\Language',
    'extends' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Language\\LanguageToFontInterface',
    ),
  ),
  'Mpdf\\Language\\ScriptToLanguageInterface' => 
  array (
    'type' => 'interface',
    'interfacename' => 'ScriptToLanguageInterface',
    'namespace' => 'Mpdf\\Language',
    'extends' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Language\\ScriptToLanguageInterface',
    ),
  ),
  'Mpdf\\Watermark' => 
  array (
    'type' => 'interface',
    'interfacename' => 'Watermark',
    'namespace' => 'Mpdf',
    'extends' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\Mpdf\\Watermark',
    ),
  ),
  'DeepCopy\\Filter\\Filter' => 
  array (
    'type' => 'interface',
    'interfacename' => 'Filter',
    'namespace' => 'DeepCopy\\Filter',
    'extends' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\DeepCopy\\Filter\\Filter',
    ),
  ),
  'DeepCopy\\Matcher\\Matcher' => 
  array (
    'type' => 'interface',
    'interfacename' => 'Matcher',
    'namespace' => 'DeepCopy\\Matcher',
    'extends' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\DeepCopy\\Matcher\\Matcher',
    ),
  ),
  'DeepCopy\\TypeFilter\\TypeFilter' => 
  array (
    'type' => 'interface',
    'interfacename' => 'TypeFilter',
    'namespace' => 'DeepCopy\\TypeFilter',
    'extends' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\DeepCopy\\TypeFilter\\TypeFilter',
    ),
  ),
  'Psr\\Http\\Message\\MessageInterface' => 
  array (
    'type' => 'interface',
    'interfacename' => 'MessageInterface',
    'namespace' => 'Psr\\Http\\Message',
    'extends' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\Psr\\Http\\Message\\MessageInterface',
    ),
  ),
  'Psr\\Http\\Message\\RequestInterface' => 
  array (
    'type' => 'interface',
    'interfacename' => 'RequestInterface',
    'namespace' => 'Psr\\Http\\Message',
    'extends' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\Psr\\Http\\Message\\RequestInterface',
    ),
  ),
  'Psr\\Http\\Message\\ResponseInterface' => 
  array (
    'type' => 'interface',
    'interfacename' => 'ResponseInterface',
    'namespace' => 'Psr\\Http\\Message',
    'extends' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\Psr\\Http\\Message\\ResponseInterface',
    ),
  ),
  'Psr\\Http\\Message\\ServerRequestInterface' => 
  array (
    'type' => 'interface',
    'interfacename' => 'ServerRequestInterface',
    'namespace' => 'Psr\\Http\\Message',
    'extends' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\Psr\\Http\\Message\\ServerRequestInterface',
    ),
  ),
  'Psr\\Http\\Message\\StreamInterface' => 
  array (
    'type' => 'interface',
    'interfacename' => 'StreamInterface',
    'namespace' => 'Psr\\Http\\Message',
    'extends' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\Psr\\Http\\Message\\StreamInterface',
    ),
  ),
  'Psr\\Http\\Message\\UploadedFileInterface' => 
  array (
    'type' => 'interface',
    'interfacename' => 'UploadedFileInterface',
    'namespace' => 'Psr\\Http\\Message',
    'extends' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\Psr\\Http\\Message\\UploadedFileInterface',
    ),
  ),
  'Psr\\Http\\Message\\UriInterface' => 
  array (
    'type' => 'interface',
    'interfacename' => 'UriInterface',
    'namespace' => 'Psr\\Http\\Message',
    'extends' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\Psr\\Http\\Message\\UriInterface',
    ),
  ),
  'Psr\\Log\\LoggerAwareInterface' => 
  array (
    'type' => 'interface',
    'interfacename' => 'LoggerAwareInterface',
    'namespace' => 'Psr\\Log',
    'extends' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\Psr\\Log\\LoggerAwareInterface',
    ),
  ),
  'Psr\\Log\\LoggerInterface' => 
  array (
    'type' => 'interface',
    'interfacename' => 'LoggerInterface',
    'namespace' => 'Psr\\Log',
    'extends' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\Psr\\Log\\LoggerInterface',
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\CrossReference\\ReaderInterface' => 
  array (
    'type' => 'interface',
    'interfacename' => 'ReaderInterface',
    'namespace' => 'setasign\\Fpdi\\PdfParser\\CrossReference',
    'extends' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\CrossReference\\ReaderInterface',
    ),
  ),
  'setasign\\Fpdi\\PdfParser\\Filter\\FilterInterface' => 
  array (
    'type' => 'interface',
    'interfacename' => 'FilterInterface',
    'namespace' => 'setasign\\Fpdi\\PdfParser\\Filter',
    'extends' => 
    array (
      0 => 'WPO\\IPS\\Mpdf\\Vendor\\setasign\\Fpdi\\PdfParser\\Filter\\FilterInterface',
    ),
  ),
);

        public function __construct()
        {
            $this->includeFilePath = __DIR__ . '/autoload_alias.php';
        }

        /**
         * @param string $class
         */
        public function autoload($class): void
        {
            if (!isset($this->autoloadAliases[$class])) {
                return;
            }
            switch ($this->autoloadAliases[$class]['type']) {
                case 'class':
                        $this->load(
                            $this->classTemplate(
                                $this->autoloadAliases[$class]
                            )
                        );
                    break;
                case 'interface':
                    $this->load(
                        $this->interfaceTemplate(
                            $this->autoloadAliases[$class]
                        )
                    );
                    break;
                case 'trait':
                    $this->load(
                        $this->traitTemplate(
                            $this->autoloadAliases[$class]
                        )
                    );
                    break;
                default:
                    // Never.
                    break;
            }
        }

        private function load(string $includeFile): void
        {
            file_put_contents($this->includeFilePath, $includeFile);
            include $this->includeFilePath;
            file_exists($this->includeFilePath) && unlink($this->includeFilePath);
        }

        /**
         * @param ClassAliasArray $class
         */
        private function classTemplate(array $class): string
        {
            $abstract = $class['isabstract'] ? 'abstract ' : '';
            $classname = $class['classname'];
            if (isset($class['namespace'])) {
                $namespace = "namespace {$class['namespace']};";
                $extends = '\\' . $class['extends'];
                $implements = empty($class['implements']) ? ''
                : ' implements \\' . implode(', \\', $class['implements']);
            } else {
                $namespace = '';
                $extends = $class['extends'];
                $implements = !empty($class['implements']) ? ''
                : ' implements ' . implode(', ', $class['implements']);
            }
            return <<<EOD
                <?php
                $namespace
                $abstract class $classname extends $extends $implements {}
                EOD;
        }

        /**
         * @param InterfaceAliasArray $interface
         */
        private function interfaceTemplate(array $interface): string
        {
            $interfacename = $interface['interfacename'];
            $namespace = isset($interface['namespace'])
            ? "namespace {$interface['namespace']};" : '';
            $extends = isset($interface['namespace'])
            ? '\\' . implode('\\ ,', $interface['extends'])
            : implode(', ', $interface['extends']);
            return <<<EOD
                <?php
                $namespace
                interface $interfacename extends $extends {}
                EOD;
        }

        /**
         * @param TraitAliasArray $trait
         */
        private function traitTemplate(array $trait): string
        {
            $traitname = $trait['traitname'];
            $namespace = isset($trait['namespace'])
            ? "namespace {$trait['namespace']};" : '';
            $uses = isset($trait['namespace'])
            ? '\\' . implode(';' . PHP_EOL . '    use \\', $trait['use'])
            : implode(';' . PHP_EOL . '    use ', $trait['use']);
            return <<<EOD
                <?php
                $namespace
                trait $traitname { 
                    use $uses; 
                }
                EOD;
        }
    }

    spl_autoload_register([ new AliasAutoloader(), 'autoload' ]);
}
