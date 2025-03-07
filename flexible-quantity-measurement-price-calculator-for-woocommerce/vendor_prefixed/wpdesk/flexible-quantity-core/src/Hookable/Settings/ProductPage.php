<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Settings;

use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\PostType\FQTemplateType;
use WDFQVendorFree\WPDesk\Translation\Translate;
use WDFQVendorFree\WPDesk\View\Renderer\Renderer;
use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\TemplateFinder;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\SettingsContainer;
/**
 * Product page settings.
 */
class ProductPage implements Hookable
{
    private Renderer $renderer;
    private TemplateFinder $template_finder;
    private SettingsContainer $settings_container;
    private Translate $translate;
    private bool $is_locked;
    public const ASSIGN_PRODUCT_VAR_NAME = 'assign_product';
    public const CREATE_FROM_PRODUCT_VAR_NAME = 'create_from_product';
    public function __construct(Renderer $renderer, TemplateFinder $template_finder, SettingsContainer $settings_container, Translate $translate, bool $is_locked)
    {
        $this->renderer = $renderer;
        $this->template_finder = $template_finder;
        $this->settings_container = $settings_container;
        $this->translate = $translate;
        $this->is_locked = $is_locked;
    }
    public function hooks()
    {
        add_action('woocommerce_product_write_panel_tabs', [$this, 'add_tab'], 99);
        add_action('woocommerce_product_data_panels', [$this, 'add_panel'], 99);
        add_action('woocommerce_product_options_pricing', [$this, 'add_price_info'], 20);
    }
    /**
     * Adds the "Calculator" tab to the Product Data postbox in the admin product interface
     */
    public function add_tab()
    {
        $this->renderer->output_render('settings/product/tab');
    }
    public function add_panel()
    {
        global $post;
        $product = \wc_get_product($post->ID);
        if (!$product instanceof \WC_Product) {
            return;
        }
        $this->renderer->output_render('settings/product/panel', ['template_url' => $this->get_template_url($product)]);
    }
    public function add_price_info(): void
    {
        global $post;
        $product = \wc_get_product($post->ID);
        if (!$product instanceof \WC_Product) {
            return;
        }
        $settings = $this->settings_container->get($product);
        if (!$settings->is_calculator_enabled() || $settings->is_default_price_enabled()) {
            return;
        }
        $template_id = $this->template_finder->get($product);
        if ($template_id <= 0) {
            return;
        }
        $template_url = admin_url('post.php?post=' . $template_id . '&action=edit');
        $pro_url = $this->translate->__('url.pro.template.basic_settings');
        $this->renderer->output_render('settings/product/price-settings', ['template_url' => $template_url, 'is_locked' => $this->is_locked, 'pro_url' => $pro_url]);
    }
    private function get_template_url(\WC_Product $product): string
    {
        $settings = $this->settings_container->get($product);
        // not FQ product.
        if (!$settings->is_calculator_enabled()) {
            return \admin_url('edit.php?post_type=' . FQTemplateType::POST_TYPE);
        }
        // product already assigned to a template.
        $template_id = $this->template_finder->get($product);
        if ($template_id > 0) {
            return \admin_url('post.php?post=' . $template_id . '&action=edit');
        }
        // product is not assigned to a template, but maybe there is a template that we can assign it to.
        $template_id = $this->template_finder->get_by_settings($settings->get_settings());
        if ($template_id > 0) {
            return \admin_url('post.php?post=' . $template_id . '&action=edit&' . self::ASSIGN_PRODUCT_VAR_NAME . '=' . $product->get_id());
        }
        // no template found, create one.
        return \admin_url('post-new.php?post_type=' . FQTemplateType::POST_TYPE . '&' . self::CREATE_FROM_PRODUCT_VAR_NAME . '=' . $product->get_id());
    }
}
