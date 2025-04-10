<?php

namespace WDFQVendorFree\WPDesk\Forms\Serializer;

use WDFQVendorFree\WPDesk\Forms\Serializer;
class SerializeSerializer implements Serializer
{
    public function serialize($value)
    {
        return serialize($value);
    }
    public function unserialize($value)
    {
        return unserialize($value);
    }
}
