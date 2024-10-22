<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Calculator;

use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Settings;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Measurement;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Cart;
/**
 * Calculates total measurement needed.
 */
class MeasurementCalculator
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
     * Calculate total measurement needed (all dimensions) in pricing unit
     *
     * @param Measurement[] $measurements
     *
     * @return Measurement
     */
    public function calculate(array $measurements): Measurement
    {
        $measurement_type = $this->settings->get_calculator_type();
        $measurement_needed = 0;
        switch ($measurement_type) {
            case 'area-surface':
                $measurement_needed = $this->calulate_area_surface_measurement_needed($measurements);
                break;
            case 'area-linear':
                $measurement_needed = $this->calulate_area_linear_measurement_needed($measurements);
                break;
            default:
                $measurement_needed = $this->calculate_default_measurement_needed($measurements);
                break;
        }
        $measurement_needed_unit = Measurement::get_standard_unit($this->settings->get_pricing_unit());
        $measurement_needed = Measurement::convert($measurement_needed, $measurement_needed_unit, $this->settings->get_pricing_unit());
        $measurement_needed = (float) \wc_format_decimal($measurement_needed, $this->get_runding_precision());
        return new Measurement($this->settings->get_pricing_unit(), $measurement_needed, $measurement_type);
    }
    /**
     * @param Measurement[] $measurements
     */
    private function calculate_default_measurement_needed(array $measurements): float
    {
        return \array_reduce($measurements, function ($carry, $measurement) {
            return $carry * $measurement->get_value_common();
        }, 1);
    }
    /**
     * @param Measurement[] $measurements
     */
    private function calulate_area_linear_measurement_needed(array $measurements): float
    {
        return \array_reduce($measurements, function ($carry, $measurement) {
            return $carry + 2 * $measurement->get_value_common();
        }, 0);
    }
    /**
     * @param Measurement[] $measurements
     */
    private function calulate_area_surface_measurement_needed(array $measurements): float
    {
        $dimensions = array_reduce($measurements, function ($carry, $measurement) {
            if (array_key_exists($measurement->get_name(), $carry)) {
                $carry[$measurement->get_name()] = $measurement->get_value_common();
            }
            return $carry;
        }, ['length' => 0, 'width' => 0, 'height' => 0]);
        $length = $dimensions['length'];
        $width = $dimensions['width'];
        $height = $dimensions['height'];
        return 2 * ($length * $width + $width * $height + $length * $height);
    }
    /**
     * Get rounding precision for measurement needed
     */
    private function get_runding_precision(): int
    {
        $increment = $this->settings->get_basic_increment();
        if ($increment !== '') {
            return \strlen(\substr(\strrchr($increment, '.'), 1));
        }
        return Cart::DEFAULT_MEASUREMENT_NEEDED_ROUNDING_PRECISION;
    }
}
