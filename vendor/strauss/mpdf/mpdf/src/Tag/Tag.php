<?php

namespace WPO\IPS\Mpdf\Vendor\Mpdf\Tag;

use WPO\IPS\Mpdf\Vendor\Mpdf\Strict;

use WPO\IPS\Mpdf\Vendor\Mpdf\Cache;
use WPO\IPS\Mpdf\Vendor\Mpdf\Color\ColorConverter;
use WPO\IPS\Mpdf\Vendor\Mpdf\CssManager;
use WPO\IPS\Mpdf\Vendor\Mpdf\Form;
use WPO\IPS\Mpdf\Vendor\Mpdf\Image\ImageProcessor;
use WPO\IPS\Mpdf\Vendor\Mpdf\Language\LanguageToFontInterface;
use WPO\IPS\Mpdf\Vendor\Mpdf\Mpdf;
use WPO\IPS\Mpdf\Vendor\Mpdf\Otl;
use WPO\IPS\Mpdf\Vendor\Mpdf\SizeConverter;
use WPO\IPS\Mpdf\Vendor\Mpdf\TableOfContents;

abstract class Tag
{

	use Strict;

	/**
	 * @var \WPO\IPS\Mpdf\Vendor\Mpdf\Mpdf
	 */
	protected $mpdf;

	/**
	 * @var \WPO\IPS\Mpdf\Vendor\Mpdf\Cache
	 */
	protected $cache;

	/**
	 * @var \WPO\IPS\Mpdf\Vendor\Mpdf\CssManager
	 */
	protected $cssManager;

	/**
	 * @var \WPO\IPS\Mpdf\Vendor\Mpdf\Form
	 */
	protected $form;

	/**
	 * @var \WPO\IPS\Mpdf\Vendor\Mpdf\Otl
	 */
	protected $otl;

	/**
	 * @var \WPO\IPS\Mpdf\Vendor\Mpdf\TableOfContents
	 */
	protected $tableOfContents;

	/**
	 * @var \WPO\IPS\Mpdf\Vendor\Mpdf\SizeConverter
	 */
	protected $sizeConverter;

	/**
	 * @var \WPO\IPS\Mpdf\Vendor\Mpdf\Color\ColorConverter
	 */
	protected $colorConverter;

	/**
	 * @var \WPO\IPS\Mpdf\Vendor\Mpdf\Image\ImageProcessor
	 */
	protected $imageProcessor;

	/**
	 * @var \WPO\IPS\Mpdf\Vendor\Mpdf\Language\LanguageToFontInterface
	 */
	protected $languageToFont;

	const ALIGN = [
		'left' => 'L',
		'center' => 'C',
		'right' => 'R',
		'top' => 'T',
		'text-top' => 'TT',
		'middle' => 'M',
		'baseline' => 'BS',
		'bottom' => 'B',
		'text-bottom' => 'TB',
		'justify' => 'J'
	];

	public function __construct(
		Mpdf $mpdf,
		Cache $cache,
		CssManager $cssManager,
		Form $form,
		Otl $otl,
		TableOfContents $tableOfContents,
		SizeConverter $sizeConverter,
		ColorConverter $colorConverter,
		ImageProcessor $imageProcessor,
		LanguageToFontInterface $languageToFont
	) {

		$this->mpdf = $mpdf;
		$this->cache = $cache;
		$this->cssManager = $cssManager;
		$this->form = $form;
		$this->otl = $otl;
		$this->tableOfContents = $tableOfContents;
		$this->sizeConverter = $sizeConverter;
		$this->colorConverter = $colorConverter;
		$this->imageProcessor = $imageProcessor;
		$this->languageToFont = $languageToFont;
	}

	public function getTagName()
	{
		$tag = get_class($this);
		return strtoupper(str_replace('WPO\IPS\Mpdf\Vendor\Mpdf\Tag\\', '', $tag));
	}

	protected function getAlign($property)
	{
		$property = strtolower($property);
		return array_key_exists($property, self::ALIGN) ? self::ALIGN[$property] : '';
	}

	abstract public function open($attr, &$ahtml, &$ihtml);

	abstract public function close(&$ahtml, &$ihtml);

}
