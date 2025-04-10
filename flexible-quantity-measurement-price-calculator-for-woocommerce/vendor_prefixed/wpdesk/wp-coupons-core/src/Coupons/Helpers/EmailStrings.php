<?php

namespace WDFQVendorFree\WPDesk\Library\WPCoupons\Helpers;

/**
 * Define default email strings.
 */
class EmailStrings
{
    public static function get_default_email_subject(): string
    {
        return __('[{site_title}] You have received a coupon', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
    }
    public static function get_default_email_body(): string
    {
        //phpcs:disable
        return __('Hi {recipient_name},', 'flexible-quantity-measurement-price-calculator-for-woocommerce') . \PHP_EOL . \PHP_EOL . __('Thanks to {buyer_name} you get a gift voucher for use in the {site_url} ({site_title}) store.', 'flexible-quantity-measurement-price-calculator-for-woocommerce') . \PHP_EOL . \PHP_EOL . __('Download PDF with the coupon from: {coupon_url}', 'flexible-quantity-measurement-price-calculator-for-woocommerce') . \PHP_EOL . \PHP_EOL . __('Coupon information', 'flexible-quantity-measurement-price-calculator-for-woocommerce') . \PHP_EOL . __('Coupon code: {coupon_code}', 'flexible-quantity-measurement-price-calculator-for-woocommerce') . \PHP_EOL . __('Coupon value: {coupon_value}', 'flexible-quantity-measurement-price-calculator-for-woocommerce') . \PHP_EOL . __('Expiry date: {coupon_expiry}', 'flexible-quantity-measurement-price-calculator-for-woocommerce') . \PHP_EOL . \PHP_EOL . __('A message from the buyer:', 'flexible-quantity-measurement-price-calculator-for-woocommerce') . \PHP_EOL . __('{recipient_message}', 'flexible-quantity-measurement-price-calculator-for-woocommerce') . \PHP_EOL . \PHP_EOL . __('Thanks for reading!', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
        //phpcs:enable
    }
}
