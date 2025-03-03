<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services;

/**
 * General settings for the plugin.
 */
class Config
{
    public function get_measurement_step_value(): string
    {
        /**
         * Filter the number of allowed decimals for the measurement step value.
         *
         * @param int $allowed_decimals The number of allowed decimals.
         */
        $allowed_decimals = \apply_filters('fq_allowed_measurement_decimals', 4);
        $allowed_decimals = \absint($allowed_decimals);
        // Calculate the step value based on the number of allowed decimals.
        $step = 1 / pow(10, $allowed_decimals);
        return (string) $step;
    }
}
