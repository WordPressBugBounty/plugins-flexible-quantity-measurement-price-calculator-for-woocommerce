<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Validator;

use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Measurement;
/**
 * Validate measurement input data.
 */
class MeasurementValidator
{
    /**
     * @var array<ValidatorInterface>
     */
    private $validators;
    public function __construct(\WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Validator\ValidatorInterface ...$validators)
    {
        $this->validators = $validators;
    }
    /**
     * @param array<Measurement> $measurements
     *
     * @return ValidationResult
     */
    public function validate(array $measurements) : \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Validator\ValidationResult
    {
        $result = new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Validator\ValidationResult();
        foreach ($measurements as $measurement) {
            foreach ($this->validators as $validator) {
                $error_msg = $validator->validate($measurement);
                if ('' !== $error_msg) {
                    $result->add_error($measurement->get_name(), $error_msg);
                }
            }
        }
        return $result;
    }
}
