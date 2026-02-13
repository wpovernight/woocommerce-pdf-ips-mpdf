<?php

namespace WPO\IPS\Mpdf\Vendor\DeepCopy\Matcher;

interface Matcher
{
    /**
     * @param object $object
     * @param string $property
     *
     * @return boolean
     */
    public function matches($object, $property);
}
