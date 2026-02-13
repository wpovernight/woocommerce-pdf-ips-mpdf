<?php

namespace WPO\IPS\Mpdf\Vendor\Mpdf\PsrLogAwareTrait;

use WPO\IPS\Mpdf\Vendor\Psr\Log\LoggerInterface;

trait PsrLogAwareTrait 
{

	/**
	 * @var \WPO\IPS\Mpdf\Vendor\Psr\Log\LoggerInterface
	 */
	protected $logger;

	public function setLogger(LoggerInterface $logger): void
	{
		$this->logger = $logger;
	}
	
}
