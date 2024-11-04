<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\PostType;

use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable;
class FQTemplateType implements Hookable
{
    const POST_TYPE = 'fq_template';
    public function hooks(): void
    {
        add_action('init', $this, 10);
    }
    /**
     * Register post types.
     */
    public function __invoke(): void
    {
        \register_post_type(self::POST_TYPE, ['labels' => ['name' => __('Template', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'singular_name' => __('Template', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'menu_name' => __('Flexible Quantity', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'parent_item_colon' => '', 'all_items' => __('Templates', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'view_item' => __('View Templates', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'add_new_item' => __('Add New Template', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'add_new' => __('Add New', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'edit_item' => __('Edit Template', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'update_item' => __('Save Template', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'search_items' => __('Search Template', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'not_found' => __('Template not found', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'not_found_in_trash' => __('Template not found in trash', 'flexible-quantity-measurement-price-calculator-for-woocommerce')], 'description' => __('Flexible Quantity Templates', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'public' => \false, 'show_ui' => \true, 'capability_type' => 'post', 'capabilities' => [], 'map_meta_cap' => \true, 'publicly_queryable' => \false, 'exclude_from_search' => \true, 'hierarchical' => \false, 'query_var' => \true, 'supports' => ['title'], 'has_archive' => \false, 'show_in_nav_menus' => \true, 'show_in_menu' => \true, 'menu_icon' => 'dashicons-calculator']);
    }
}
