<?php

namespace WDFQVendorFree\WPDesk\Forms\Serializer;

use WDFQVendorFree\WPDesk\Forms\Serializer;
class NoSerialize implements Serializer
{
    public function serialize($value)
    {
        return $value;
    }
    public function unserialize($value)
    {
        return $value;
    }
}
