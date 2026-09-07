<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce;

class MeasurementMeta
{
    /**
     * Returns the unit recorded for the persisted measurement.
     *
     * Versioned data carries a trusted unit. Legacy data has no trusted unit,
     * so its value is interpreted in the current pricing unit.
     *
     * @param array<string, mixed> $measurement_data persisted FQ measurement data
     * @param string               $pricing_unit current pricing unit
     */
    public static function get_recorded_unit(array $measurement_data, string $pricing_unit): string
    {
        return !empty($measurement_data['_measurement_needed_unit_normalized']) ? $measurement_data['_measurement_needed_unit'] ?? $pricing_unit : $pricing_unit;
    }
    /**
     * Builds the total measurement from persisted FQ measurement data.
     *
     * @param array<string, mixed> $measurement_data persisted FQ measurement data
     * @param string               $pricing_unit current pricing unit
     */
    public static function get_total_measurement(array $measurement_data, string $pricing_unit): Measurement
    {
        $measurement = new Measurement(self::get_recorded_unit($measurement_data, $pricing_unit), $measurement_data['_measurement_needed']);
        if (!empty($measurement_data['_measurement_needed_unit_normalized'])) {
            $measurement->set_unit($pricing_unit);
        }
        return $measurement;
    }
}
