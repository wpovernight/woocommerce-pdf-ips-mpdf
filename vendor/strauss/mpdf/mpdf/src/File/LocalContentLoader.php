<?php

namespace WPO\IPS\Mpdf\Vendor\Mpdf\File;

class LocalContentLoader implements \WPO\IPS\Mpdf\Vendor\Mpdf\File\LocalContentLoaderInterface
{

	public function load($path)
	{
		return file_get_contents($path);
	}

}
