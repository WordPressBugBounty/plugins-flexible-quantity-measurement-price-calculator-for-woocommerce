<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Calculator;

use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Measurement;
/**
 * Calculate product weight.
 */
class WeightCalculator
{
    /**
     * @var string
     */
    private $calculator_type;
    /**
     * @var string
     */
    private $woo_weight_unit;
    /**
     * @var string
     */
    private $woo_product_weight;
    public function __construct(string $calculator_type, string $woo_product_weight, string $woo_weight_unit)
    {
        $this->calculator_type = $calculator_type;
        $this->woo_product_weight = $woo_product_weight;
        $this->woo_weight_unit = $woo_weight_unit;
    }
    public function calculate(Measurement $measurement): float
    {
        if ('weight' === $this->calculator_type) {
            return $this->calculate_for_weight_product_type($measurement);
        }
        return $this->calculate_default_measurement_type($measurement, $this->woo_product_weight);
    }
    public function calculate_default_measurement_type(Measurement $measurement): float
    {
        return (float) $this->woo_product_weight * $measurement->get_value();
    }
    public function calculate_for_weight_product_type(Measurement $measurement): float
    {
        return (float) $measurement->get_value($this->woo_weight_unit);
    }
}
