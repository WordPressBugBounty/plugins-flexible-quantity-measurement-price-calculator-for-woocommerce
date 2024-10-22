<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Validator;

use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Settings;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Measurement;
/**
 * Validate if measurement input is in range.
 */
class InRangeValidator implements ValidatorInterface
{
    /**
     * @var Settings
     */
    private $settings;
    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }
    public function validate(Measurement $measurement): string
    {
        $input_attributes = $this->settings->get_input_attributes($measurement->get_name());
        $input_minimum = isset($input_attributes['min']) && \is_numeric($input_attributes['min']) ? (float) \abs($input_attributes['min']) : null;
        $input_maximum = isset($input_attributes['max']) && \is_numeric($input_attributes['max']) ? (float) \abs($input_attributes['max']) : null;
        if ($input_minimum && $measurement->get_value() < $input_minimum) {
            return sprintf(
                /* translators: Placeholders: %1$s - measurement label, %2$s - measurement value (number) */
                __('%1$s value must be greater than or equal to %2$s.', 'flexible-quantity-measurement-price-calculator-for-woocommerce'),
                $measurement->get_label(),
                $input_minimum
            );
        }
        if ($input_maximum && $measurement->get_value() > $input_maximum) {
            return sprintf(
                /* translators: Placeholders: %1$s - measurement label, %2$s - measurement value (number) */
                __('%1$s value must be less than or equal to %2$s.', 'flexible-quantity-measurement-price-calculator-for-woocommerce'),
                $measurement->get_label(),
                $input_maximum
            );
        }
        return '';
    }
}
