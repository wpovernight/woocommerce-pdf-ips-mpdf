<?php

namespace WPO\IPS\Mpdf\Vendor\Mpdf\Http;

use WPO\IPS\Mpdf\Vendor\Psr\Http\Message\RequestInterface;

interface ClientInterface
{

	public function sendRequest(RequestInterface $request);

}
