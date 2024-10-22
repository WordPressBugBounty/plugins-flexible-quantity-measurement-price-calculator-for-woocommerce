<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Validator;

use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Measurement;
use WP_Error;
/**
 * Validates if measurement input is a positive number.
 */
class PositiveNumberValidator implements ValidatorInterface
{
    public function validate(Measurement $measurement): string
    {
        if (!is_numeric($measurement->get_value()) || $measurement->get_value() <= 0) {
            return sprintf(
                /* translators: Placeholders: %s - measurement label */
                __('%s must be a positive number.', 'flexible-quantity-measurement-price-calculator-for-woocommerce'),
                $measurement->get_label()
            );
        }
        return '';
    }
}
