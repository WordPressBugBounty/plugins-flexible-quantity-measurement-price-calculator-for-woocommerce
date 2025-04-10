<?php

namespace WDFQVendorFree\WPDesk\Forms\Sanitizer;

use WDFQVendorFree\WPDesk\Forms\Sanitizer;
class NoSanitize implements Sanitizer
{
    public function sanitize($value)
    {
        return $value;
    }
}
