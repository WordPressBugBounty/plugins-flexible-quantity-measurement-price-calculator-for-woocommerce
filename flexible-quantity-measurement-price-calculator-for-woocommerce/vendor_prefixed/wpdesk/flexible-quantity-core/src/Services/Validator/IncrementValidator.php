<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Validator;

use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Settings;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Measurement;
/**
 * Validate if measurement input is a multiple of increment.
 */
class IncrementValidator implements ValidatorInterface
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
        $input_increment = isset($input_attributes['step']) && is_numeric($input_attributes['step']) ? (float) abs($input_attributes['step']) : 0;
        if ($input_increment === 0) {
            return '';
        }
        $increment_ratio = $measurement->get_value() / $input_increment;
        $is_multiple = abs($increment_ratio - round($increment_ratio)) < 0.0001;
        if (!$is_multiple) {
            return sprintf(
                /* translators: Placeholders: %1$s - measurement label, %2$s - input measure increment value (step amount) */
                __('%1$s value must be in increments of %2$s.', 'flexible-quantity-measurement-price-calculator-for-woocommerce'),
                $measurement->get_label(),
                $input_increment
            );
        }
        return '';
    }
}
