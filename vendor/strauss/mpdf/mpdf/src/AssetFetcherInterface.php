<?php

namespace WPO\IPS\Mpdf\Vendor\Mpdf;

interface AssetFetcherInterface
{
	/**
	 * Fetch data from a given path, either local or remote.
	 *
	 * @param string $path The path to fetch data from.
	 * @param string|null $originalSrc The original source path, if applicable.
	 * @return string The fetched data.
	 * @throws \WPO\IPS\Mpdf\Vendor\Mpdf\Exception\AssetFetchingException If fetching fails.
	 */
	public function fetchDataFromPath($path, $originalSrc = null);
}
