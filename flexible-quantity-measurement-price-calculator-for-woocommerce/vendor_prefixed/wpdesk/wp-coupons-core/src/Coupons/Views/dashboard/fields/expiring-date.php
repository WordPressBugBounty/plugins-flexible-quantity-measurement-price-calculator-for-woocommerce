<?php

namespace WDFQVendorFree;

/**
 * Expiring date field template.
 *
 * This template can be used in simple product PDF coupon settings or variations.
 */
use WDFQVendorFree\WPDesk\Library\WPCoupons\Integration\PostMeta;
$params = isset($params) ? (array) $params : [];
/**
 * @var PostMeta $meta
 */
$meta = $params['post_meta'];
$prod_post_id = $params['post_id'];
$is_premium = $params['is_premium'];
$loop_id = isset($params['loop']) ? '_variation' . $params['loop'] : '';
$loop_name = isset($params['loop']) ? "_variation[{$params['loop']}]" : '';
$parent_id = isset($params['parent_id']) ? $params['parent_id'] : null;
// Get the parent default meta value for variable.
$default = $meta->get_private($parent_id, 'flexible_coupon_expiring_date', $is_premium ? 365 : 7);
$value = $meta->get_private($prod_post_id, 'flexible_coupon_expiring_date', $default);
$expiring_options = ['0' => \esc_html__('never', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), '7' => \esc_html__('7 days', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), '14' => \esc_html__('14 days', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), '30' => \esc_html__('30 days', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), '60' => \esc_html__('60 days', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), '90' => \esc_html__('90 days', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), '365' => \esc_html__('365 days', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'own' => \esc_html__('Set your own date', 'flexible-quantity-measurement-price-calculator-for-woocommerce')];
\woocommerce_wp_select(['id' => 'fc_expiring_date' . $loop_id, 'name' => 'fc_expiring_date' . $loop_name, 'value' => $value, 'label' => \esc_html__('Expiration time', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'desc_tip' => \true, 'options' => $expiring_options, 'description' => \esc_html__('Time from purchase to expiration of a generated coupon', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'wrapper_class' => !$is_premium ? 'read-only' : '', 'class' => 'expiring-date-select short']);
