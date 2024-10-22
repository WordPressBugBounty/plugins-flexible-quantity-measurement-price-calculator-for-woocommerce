<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Calculator;

use Exception;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Settings;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Measurement;
/**
 * Calculates price of a product based on measurements.
 */
class PriceCalculator
{
    /**
     * @var Settings
     */
    private $settings;
    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }
    /**
     * Calculate price based on given measurements
     *
     * @param Measurement[] $measurements
     * @param float         $price
     *
     * @return float
     */
    public function calculate(Measurement $measurement, float $price): float
    {
        // if this calculator uses pricing rules, retrieve the price based on the product measurements.
        $rule_price = $this->settings->get_pricing_rules_price($measurement);
        $price = $rule_price > 0 ? (float) $rule_price : $price;
        // calculate the price.
        $price = $price * $measurement->get_value($this->settings->get_pricing_unit());
        return $price;
    }
}
