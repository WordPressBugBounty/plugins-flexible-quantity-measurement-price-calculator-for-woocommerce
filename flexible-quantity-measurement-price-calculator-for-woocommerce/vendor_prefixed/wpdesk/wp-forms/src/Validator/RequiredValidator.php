<?php

namespace WDFQVendorFree\WPDesk\Forms\Validator;

use WDFQVendorFree\WPDesk\Forms\Validator;
class RequiredValidator implements Validator
{
    public function is_valid($value)
    {
        return $value !== null;
    }
    public function get_messages()
    {
        return [];
    }
}
