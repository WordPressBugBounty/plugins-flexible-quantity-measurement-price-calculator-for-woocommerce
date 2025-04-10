<?php

namespace WPDesk\Library\WPCoupons\Helpers;

/**
 * Define default email strings.
 */
class EmailStrings {

	public static function get_default_email_subject(): string {
		return __( '[{site_title}] You have received a coupon', 'wp-coupons-core' );
	}

	public static function get_default_email_body(): string {
		//phpcs:disable
		return __( 'Hi {recipient_name},', 'wp-coupons-core' ) . PHP_EOL . PHP_EOL .
		       __( 'Thanks to {buyer_name} you get a gift voucher for use in the {site_url} ({site_title}) store.', 'wp-coupons-core' ) . PHP_EOL . PHP_EOL .
		       __( 'Download PDF with the coupon from: {coupon_url}', 'wp-coupons-core' ) . PHP_EOL . PHP_EOL .
		       __( 'Coupon information', 'wp-coupons-core' ) . PHP_EOL .
		       __( 'Coupon code: {coupon_code}', 'wp-coupons-core' ) . PHP_EOL .
		       __( 'Coupon value: {coupon_value}', 'wp-coupons-core' ) . PHP_EOL .
               __( 'Expiry date: {coupon_expiry}', 'wp-coupons-core' ) . PHP_EOL . PHP_EOL .
               __( 'A message from the buyer:', 'wp-coupons-core' ) . PHP_EOL .
               __( '{recipient_message}', 'wp-coupons-core' ) . PHP_EOL . PHP_EOL .
		       __( 'Thanks for reading!', 'wp-coupons-core' );
		//phpcs:enable
	}
}
