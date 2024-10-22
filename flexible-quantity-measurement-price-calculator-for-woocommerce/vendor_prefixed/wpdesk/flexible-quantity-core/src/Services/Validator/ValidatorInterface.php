<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Validator;

use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Measurement;
interface ValidatorInterface
{
    /**
     * Validate measurement input data.
     *
     * @param Measurement $measurement
     *
     * @return string
     */
    public function validate(Measurement $measurement): string;
}
