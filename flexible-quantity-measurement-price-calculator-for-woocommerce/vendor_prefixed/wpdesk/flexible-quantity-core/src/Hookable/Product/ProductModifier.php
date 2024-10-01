<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Product;

use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\SettingsContainer;
/**
 * Modifies product settings.
 */
class ProductModifier implements \WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable
{
    /**
     * @var SettingsContainer
     */
    private $settings_container;
    public function __construct(\WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\SettingsContainer $settings_container)
    {
        $this->settings_container = $settings_container;
    }
    public function hooks()
    {
        \add_filter('woocommerce_is_purchasable', [$this, 'product_is_purchasable'], 10, 2);
        \add_filter('woocommerce_product_get_sold_individually', [$this, 'get_sold_individually'], 10, 2);
    }
    /**
     * @param bool $is_purchasable
     * @param \WC_Product $product
     *
     * @return bool
     */
    public function product_is_purchasable($is_purchasable, $product)
    {
        if (!$product instanceof \WC_Product) {
            return $is_purchasable;
        }
        if ($is_purchasable) {
            return \true;
        }
        $settings = $this->settings_container->get($product);
        if ($settings->is_calculator_enabled() && $settings->pricing_rules_enabled()) {
            return \true;
        }
        return \false;
    }
    /**
     * @param bool $sold_individually
     * @param \WC_Product $product
     *
     * @return bool
     */
    public function get_sold_individually($sold_individually, $product)
    {
        if (!$product instanceof \WC_Product) {
            return $sold_individually;
        }
        $settings = $this->settings_container->get($product);
        if ($settings->is_calculator_enabled()) {
            $sold_individually = $settings->get_sold_individually();
        }
        return $sold_individually;
    }
}
