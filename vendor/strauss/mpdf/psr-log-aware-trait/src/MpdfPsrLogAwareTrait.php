<?php

namespace WPO\IPS\Mpdf\Vendor\Mpdf\PsrLogAwareTrait;

use WPO\IPS\Mpdf\Vendor\Psr\Log\LoggerInterface;

trait MpdfPsrLogAwareTrait
{

	/**
	 * @var \WPO\IPS\Mpdf\Vendor\Psr\Log\LoggerInterface
	 */
	protected $logger;

	public function setLogger(LoggerInterface $logger): void
	{
		$this->logger = $logger;
		if (property_exists($this, 'services') && is_array($this->services)) {
			foreach ($this->services as $name) {
				if ($this->$name && $this->$name instanceof \WPO\IPS\Mpdf\Vendor\Psr\Log\LoggerAwareInterface) {
					$this->$name->setLogger($logger);
				}
			}
		}
	}

}
