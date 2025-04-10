<?php
/**
 * Expiring date field template.
 *
 * This template can be used in simple product PDF coupon settings or variations.
 */

use WPDesk\Library\WPCoupons\Integration\PostMeta;

$params = isset( $params ) ? (array) $params : [];

/**
 * @var PostMeta $meta
 */
$meta         = $params['post_meta'];
$prod_post_id = $params['post_id'];
$is_premium   = $params['is_premium'];

$loop_id   = isset( $params['loop'] ) ? '_variation' . $params['loop'] : '';
$loop_name = isset( $params['loop'] ) ? "_variation[{$params['loop']}]" : '';
$parent_id = isset( $params['parent_id'] ) ? $params['parent_id'] : null;

// Get the parent default meta value for variable.
$default = $meta->get_private( $parent_id, 'flexible_coupon_expiring_date', $is_premium ? 365 : 7 );
$value   = $meta->get_private( $prod_post_id, 'flexible_coupon_expiring_date', $default );

$expiring_options = [
	'0'   => esc_html__( 'never', 'wp-coupons-core' ),
	'7'   => esc_html__( '7 days', 'wp-coupons-core' ),
	'14'  => esc_html__( '14 days', 'wp-coupons-core' ),
	'30'  => esc_html__( '30 days', 'wp-coupons-core' ),
	'60'  => esc_html__( '60 days', 'wp-coupons-core' ),
	'90'  => esc_html__( '90 days', 'wp-coupons-core' ),
	'365' => esc_html__( '365 days', 'wp-coupons-core' ),
	'own' => esc_html__( 'Set your own date', 'wp-coupons-core' ),
];

woocommerce_wp_select(
	[
		'id'            => 'fc_expiring_date' . $loop_id,
		'name'          => 'fc_expiring_date' . $loop_name,
		'value'         => $value,
		'label'         => esc_html__( 'Expiration time', 'wp-coupons-core' ),
		'desc_tip'      => true,
		'options'       => $expiring_options,
		'description'   => esc_html__( 'Time from purchase to expiration of a generated coupon', 'wp-coupons-core' ),
		'wrapper_class' => ! $is_premium ? 'read-only' : '',
		'class'         => 'expiring-date-select short',
	]
);
