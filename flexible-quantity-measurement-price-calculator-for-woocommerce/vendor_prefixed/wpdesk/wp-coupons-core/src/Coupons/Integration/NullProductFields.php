<?php

/**
 * Integration. Coupon Fields.
 *
 * @package WPDesk\Library\WPCoupons
 */
namespace WDFQVendorFree\WPDesk\Library\WPCoupons\Integration;

use WDFQVendorFree\WPDesk\Library\CouponInterfaces\ProductFields;
/**
 * Define default fields for coupon product.
 *
 * @package WPDesk\Library\WPCoupons\Integration
 */
class NullProductFields implements ProductFields
{
    /**
     * @return array
     */
    public function get(): array
    {
        return [];
    }
    public function is_premium(): bool
    {
        return \false;
    }
}
