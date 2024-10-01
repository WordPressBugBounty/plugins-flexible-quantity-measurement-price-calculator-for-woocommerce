<?php

/**
 * Plugin main class.
 *
 * @package WPDesk\Library\FlexibleQuantityCore
 */
namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore;

use WDFQVendorFree\WPDesk\Translation\Translate;
use WDFQVendorFree\WPDesk\View\Resolver\DirResolver;
use WDFQVendorFree\WPDesk\View\Resolver\ChainResolver;
use WDFQVendorFree\WPDesk\View\Renderer\SimplePhpRenderer;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Cart;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Inventory;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Shortcodes;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\TemplateFinder;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\ProductLoop;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\ProductPage;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Compatibility;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\SettingsContainer;
use WDFQVendorFree\WPDesk\View\Renderer\Renderer;
/**
 * Main plugin class. The most important flow decisions are made here.
 *
 * @codeCoverageIgnore
 */
class PluginConfig
{
    /**
     * @var string
     */
    private $plugin_url;
    /**
     * @var string
     */
    private $plugin_path;
    /**
     * @var string
     */
    private $core_path;
    /**
     * @var string
     */
    private $script_version;
    /**
     * @var bool
     */
    private $is_locked = \true;
    /**
     * @var string
     */
    private $marketing_slug = '';
    public function __construct(string $plugin_url, string $plugin_path, string $core_path, string $script_version, string $marketing_slug, bool $is_locked = \true)
    {
        $this->plugin_url = $plugin_url;
        $this->plugin_path = $plugin_path;
        $this->core_path = $core_path;
        $this->script_version = $script_version;
        $this->is_locked = $is_locked;
        $this->marketing_slug = $marketing_slug;
    }
    public function get_hookable_elements() : array
    {
        $renderer = $this->init_renderer();
        $assets_url = $this->plugin_url . $this->core_path . '/assets';
        $template_finder = new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\TemplateFinder($this->is_locked);
        $settings_container = new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\SettingsContainer($template_finder);
        $price_modifier = new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Prices\PriceModifier($settings_container);
        $product_page_calculator = new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Page\ProductPage($settings_container, $renderer);
        $product_page = new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\ProductPage($this->plugin_url . $this->core_path, $settings_container);
        $translate = new \WDFQVendorFree\WPDesk\Translation\Translate(\get_locale());
        $translate->add_resource_file($this->plugin_path . $this->core_path . '/links.json');
        $hooks = [
            new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Inventory($settings_container),
            new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\ProductLoop($settings_container),
            // $product_page,
            new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Cart($settings_container),
            new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Shortcodes(),
            new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Compatibility($product_page, $settings_container),
            new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\PostType\FQTemplateType(),
            // Backend pages.
            new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Settings\TemplatePageDisplayer($renderer, $translate, $this->is_locked),
            new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Settings\TemplatePageSaver(),
            new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Settings\TemplatePageScripts($assets_url, $this->script_version),
            new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Settings\Ajax\DimensionsAjax($renderer),
            new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Settings\Ajax\SelectionAjax($this->is_locked),
            new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Settings\TemplateListingPage($renderer),
            new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Settings\ProductPage($renderer, $template_finder, $settings_container),
            new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Settings\CustomUnitsPage($renderer, $translate, $assets_url, $this->script_version, $this->is_locked),
            new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Settings\SupportPage($renderer, $translate, $assets_url, $this->script_version, $this->marketing_slug, $this->is_locked),
            // Frontend.
            new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Page\Ajax\CalculatorPriceAjax($settings_container, $price_modifier),
            new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Page\Ajax\CalculatorFormAjax($product_page_calculator),
            new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Page\ProductPageScripts($settings_container, $assets_url, $this->script_version),
            $product_page_calculator,
            $price_modifier,
            new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Prices\PriceHtml($settings_container),
            new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Weight\WeightModifier($settings_container),
            new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Product\ProductModifier($settings_container),
        ];
        return $hooks;
    }
    /**
     * Init renderer.
     */
    private function init_renderer() : \WDFQVendorFree\WPDesk\View\Renderer\Renderer
    {
        $resolver = new \WDFQVendorFree\WPDesk\View\Resolver\ChainResolver();
        $resolver->appendResolver(new \WDFQVendorFree\WPDesk\View\Resolver\DirResolver($this->plugin_path . $this->core_path . '/templates/'));
        return new \WDFQVendorFree\WPDesk\View\Renderer\SimplePhpRenderer($resolver);
    }
}
