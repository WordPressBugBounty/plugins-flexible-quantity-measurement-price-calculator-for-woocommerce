<?php

namespace WDFQVendorFree;

/**
 * Custom fields template.
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
$is_sending = $params['is_sending'];
$loop_id = isset($params['loop']) ? '_variation' . $params['loop'] : '';
$loop_name = isset($params['loop']) ? "_variation[{$params['loop']}]" : '';
$parent_id = isset($params['parent_id']) ? $params['parent_id'] : null;
$default = 'none';
$value = $meta->get_private($prod_post_id, 'fc_sending_delay_interval', $default);
$custom_attributes = [];
if (!$is_sending) {
    $custom_attributes = ['disabled' => 'disabled'];
}
\woocommerce_wp_select(['id' => 'fc_sending_delay_interval' . $loop_id, 'name' => 'fc_sending_delay_interval' . $loop_name, 'value' => $value, 'label' => \esc_html__('Interval', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'desc_tip' => \true, 'options' => ['hours' => \__('Hours', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'days' => \__('Days', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'weeks' => \__('Weeks', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'months' => \__('Months', 'flexible-quantity-measurement-price-calculator-for-woocommerce')], 'wrapper_class' => !$is_sending ? 'read-only' : '', 'class' => 'show_if_simple_delay short fc_variation_base_on', 'custom_attributes' => $custom_attributes]);
