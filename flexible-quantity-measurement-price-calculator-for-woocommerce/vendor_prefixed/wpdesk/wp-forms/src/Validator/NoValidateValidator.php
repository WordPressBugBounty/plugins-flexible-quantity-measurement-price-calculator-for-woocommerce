<?php

namespace WDFQVendorFree\WPDesk\Forms\Validator;

use WDFQVendorFree\WPDesk\Forms\Validator;
class NoValidateValidator implements Validator
{
    public function is_valid($value)
    {
        return \true;
    }
    public function get_messages()
    {
        return [];
    }
}
