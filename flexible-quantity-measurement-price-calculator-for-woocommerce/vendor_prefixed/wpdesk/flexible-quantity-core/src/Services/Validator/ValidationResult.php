<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Validator;

/**
 * Collects validation errors.
 */
class ValidationResult
{
    /**
     * @var array<string, string>
     */
    private $errors = [];
    public function is_valid() : bool
    {
        return \count($this->errors) === 0;
    }
    public function add_error(string $field, string $message) : void
    {
        $this->errors[$field][] = $message;
    }
    /**
     * @return array<string, string>
     */
    public function get_errors() : array
    {
        return $this->errors;
    }
}
