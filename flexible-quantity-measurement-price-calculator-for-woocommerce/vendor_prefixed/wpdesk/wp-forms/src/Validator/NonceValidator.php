<?php

namespace WDFQVendorFree\WPDesk\Forms\Validator;

use WDFQVendorFree\WPDesk\Forms\Validator;
class NonceValidator implements Validator
{
    private $action;
    public function __construct($action)
    {
        $this->action = $action;
    }
    public function is_valid($value)
    {
        $valid = wp_verify_nonce($value, $this->action);
        return $valid;
    }
    public function get_messages()
    {
        return [];
    }
}
