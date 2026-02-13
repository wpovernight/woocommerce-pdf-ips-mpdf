<?php

namespace WPO\IPS\Mpdf\Vendor\Mpdf\Container;

interface ContainerInterface
{

	public function get($id);

	public function has($id);

}
