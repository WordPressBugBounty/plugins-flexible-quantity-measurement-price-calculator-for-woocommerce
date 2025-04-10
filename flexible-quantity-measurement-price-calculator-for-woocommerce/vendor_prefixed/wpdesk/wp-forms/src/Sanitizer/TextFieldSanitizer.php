<?php

namespace WDFQVendorFree\WPDesk\Forms\Sanitizer;

use WDFQVendorFree\WPDesk\Forms\Sanitizer;
class TextFieldSanitizer implements Sanitizer
{
    public function sanitize($value)
    {
        return sanitize_text_field($value);
    }
}
