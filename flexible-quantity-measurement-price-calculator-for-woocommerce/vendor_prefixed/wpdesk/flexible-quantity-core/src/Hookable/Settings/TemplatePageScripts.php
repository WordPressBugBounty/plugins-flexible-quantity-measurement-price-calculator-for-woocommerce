<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Settings;

use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Helper;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\PostType\FQTemplateType;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Settings\Ajax\DimensionsAjax;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Settings\Ajax\SelectionAjax;
class TemplatePageScripts implements \WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable
{
    /**
     * @var string
     */
    private $assets_url;
    /**
     * @var string
     */
    private $version;
    public function __construct(string $assets_url, string $version)
    {
        $this->assets_url = $assets_url;
        $this->version = $version;
    }
    public function hooks()
    {
        \add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_scripts'], 15);
    }
    public function admin_enqueue_scripts()
    {
        global $post;
        if (!$post instanceof \WP_Post || $post->post_type !== \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\PostType\FQTemplateType::POST_TYPE) {
            return;
        }
        if (!\wp_style_is('select2', 'registered')) {
            \wp_register_style('select2', \WC()->plugin_url() . '/assets/css/select2.css', [], \defined('WC_VERSION') ? \WC_VERSION : $this->version);
        }
        \wp_enqueue_style('fq-admin', $this->assets_url . '/css/admin.css', ['select2'], $this->version);
        \wp_enqueue_script('fq-admin', $this->assets_url . '/js/admin.js', ['jquery', 'jquery-tiptip', 'select2'], $this->version);
        \wp_localize_script('fq-admin', 'fq_admin_params', [
            'ajax_url' => \admin_url('admin-ajax.php'),
            'template_id' => $post->ID,
            'action_get_options' => \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Settings\Ajax\SelectionAjax::ACTION_GET_OPTIONS,
            'action_get_selected' => \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Settings\Ajax\SelectionAjax::ACTION_GET_SELECTED,
            'selection_nonce' => \wp_create_nonce(\WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Settings\Ajax\SelectionAjax::NONCE_CONTEXT),
            // old
            'dimensions_nonce' => \wp_create_nonce(\WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Settings\Ajax\DimensionsAjax::NONCE_CONTEXT),
            'action_get_dimensions' => \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Settings\Ajax\DimensionsAjax::ACTION,
            'loader_img' => '<img class="center" src="' . \esc_url(\includes_url() . 'js/tinymce/skins/lightgray/img/loader.gif') . '" />',
            'input_filter' => \__('Only digits allowed.', 'flexible-quantity-measurement-price-calculator-for-woocommerce'),
            'woocommerce_currency_symbol' => \get_woocommerce_currency_symbol(),
            'woocommerce_weight_unit' => 'no' !== \get_option('woocommerce_enable_weight', \true) ? \get_option('woocommerce_weight_unit') : '',
            'pricing_rules_enabled_notice' => \__('Cannot edit price while a pricing table is active', 'flexible-quantity-measurement-price-calculator-for-woocommerce'),
            'is_variable_product_with_stock_managed' => \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Helper::is_variable_product_with_stock_managed(\wc_get_product($post)),
        ]);
    }
}
