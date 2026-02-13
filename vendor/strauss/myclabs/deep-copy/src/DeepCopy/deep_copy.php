<?php

namespace WPO\IPS\Mpdf\Vendor\DeepCopy;

use function function_exists;

if (false === function_exists('WPO\IPS\Mpdf\Vendor\DeepCopy\deep_copy')) {
    /**
     * Deep copies the given value.
     *
     * @param mixed $value
     * @param bool  $useCloneMethod
     *
     * @return mixed
     */
    function deep_copy($value, $useCloneMethod = false)
    {
        return (new DeepCopy($useCloneMethod))->copy($value);
    }
}
