<?php
/**
 * Multi use template field.
 *
 * This template can be used in simple product PDF coupon settings or variations.
 */

use WPDesk\Library\WPCoupons\Integration\PostMeta;

$params = isset( $params ) ? (array) $params : [];

/**
 * @var PostMeta $meta
 */
$meta              = $params['post_meta'];
$prod_post_id      = $params['post_id'];
$is_premium        = $params['is_premium'];
$custom_attributes = $params['custom_attributes'];

$loop_id   = isset( $params['loop'] ) ? '_variation' . $params['loop'] : '';
$loop_name = isset( $params['loop'] ) ? "_variation[{$params['loop']}]" : '';
$parent_id = isset( $params['parent_id'] ) ? $params['parent_id'] : null;

// Get the parent default meta value for variable.
$default = $meta->get_private( $parent_id, 'flexible_coupon_remove_usage_limit', 'no' );
$value   = $meta->get_private( $prod_post_id, 'flexible_coupon_remove_usage_limit', $default );

woocommerce_wp_checkbox(
	[
		'id'                => 'fc_remove_usage_limit' . $loop_id,
		'name'              => 'fc_remove_usage_limit' . $loop_name,
		'value'             => $value,
		'label'             => esc_html__( 'Allow to multiuse', 'wp-coupons-core' ),
		'desc_tip'          => true,
		'description'       => esc_html__( 'Check this option if you want to allow customer to spread the coupon value over several purchases. For example, a coupon worth $100 for two purchases of $50.', 'wp-coupons-core' ),
		'wrapper_class'     => ! $is_premium ? 'read-only' : '',
		'custom_attributes' => $custom_attributes,
	]
);
