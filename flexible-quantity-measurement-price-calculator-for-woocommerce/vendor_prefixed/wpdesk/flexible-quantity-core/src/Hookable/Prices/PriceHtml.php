<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Prices;

use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Product;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\SettingsContainer;
class PriceHtml implements Hookable
{
    /**
     * @var SettingsContainer
     */
    private SettingsContainer $settings_container;
    public function __construct(SettingsContainer $settings_container)
    {
        $this->settings_container = $settings_container;
    }
    public function hooks()
    {
        add_filter('woocommerce_get_price_html', [$this, 'price_per_unit_html'], 10, 2);
        add_filter('woocommerce_empty_price_html', [$this, 'price_per_unit_html'], 10, 2);
    }
    /**
     * Renders the price/sale price in terms of a unit of measurement for display
     * on the catalog/product pages
     *
     * @param string                         $price_html the formatted sale price
     * @param \WC_Product|\WC_Product_Variable $product    the product
     *
     * @return string the formatted sale price, per unit
     * @since 3.0
     */
    public function price_per_unit_html(string $price_html, $product)
    {
        $settings = $this->settings_container->get($product);
        if ($settings->is_calculator_enabled()) {
            if ($product->is_type('variable') && $settings->is_default_price_enabled()) {
                return $price_html . ' ' . $settings->get_pricing_label();
            }
            if ($settings->pricing_rules_enabled()) {
                $price_html = Product::get_pricing_rules_price_html($product, $settings);
            } elseif ('' !== $price_html) {
                $pricing_label = $settings->get_pricing_label();
                $price_html .= ' ' . $pricing_label;
                if ($product->is_on_sale()) {
                    $price_html = Product::get_price_html_from_to($product->get_regular_price(), $product->get_sale_price(), $pricing_label);
                } else {
                    /** This filter is documented in /src/class-wc-price-calculator-product.php */
                    $price_html = (string) \apply_filters('fq_price_calculator_get_price_html', $price_html, $product, $pricing_label, \false, \false);
                }
            }
            if ('' !== $price_html) {
                $price_html = '<span class="wc-measurement-price-calculator-price">' . $price_html . '</span>';
            }
        }
        return $price_html;
    }
}
