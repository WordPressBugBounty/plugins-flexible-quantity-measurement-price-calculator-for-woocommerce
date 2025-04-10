<?php

namespace WDFQVendorFree\WPDesk\Forms\Serializer;

use WDFQVendorFree\WPDesk\Forms\Serializer;
class JsonSerializer implements Serializer
{
    public function serialize($value)
    {
        return json_encode($value);
    }
    public function unserialize($value)
    {
        return json_decode($value, \true);
    }
}
