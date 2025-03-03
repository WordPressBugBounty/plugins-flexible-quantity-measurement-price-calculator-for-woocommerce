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
        // if this is a product variation, get the parent product which holds the calculator settings
        $_product = $product;
        $settings = $this->settings_container->get($product);
        if ($settings->is_calculator_enabled()) {
            //Display default price with unit for variable product
            if ($product->is_type('variable') && $settings->is_default_price_enabled()) {
                return $price_html . ' ' . $settings->get_pricing_label();
            }
            $basic_regular_price = $product->get_price();
            $price_html = \is_numeric($basic_regular_price) ? wc_price((float) $basic_regular_price) : $price_html;
            // if this is a quantity calculator, the displayed price per unit will have to be calculated from
            // the product price and pricing measurement.  alternatively, for a pricing calculator product,
            // the price set in the admin *is* the price per unit, so we just need to format it by adding the units
            if ($settings->is_quantity_calculator_enabled()) {
                $measurement = null;
                // for variable products we must go synchronize price levels to our per unit price
                if ($product->is_type('variable')) {
                    /** @var \WC_Product_Variable $product */
                    // synchronize to the price per unit pricing
                    Product::variable_product_sync($product, $settings);
                    // get price suffix
                    $price_suffix = $product->get_price_suffix();
                    // then remove it from the price html
                    add_filter('woocommerce_get_price_suffix', '__return_empty_string');
                    // get the appropriate price html
                    $price_html = $product->get_price_html();
                    // re-add price suffix
                    remove_filter('woocommerce_get_price_suffix', '__return_empty_string');
                    $pricing_label = $settings->get_pricing_label();
                    // add units
                    $price_html .= ' ' . $pricing_label;
                    // add price suffix
                    $price_html .= $price_suffix;
                    /** This filter is documented in /src/class-wc-price-calculator-product.php */
                    $price_html = (string) apply_filters('fq_price_calculator_get_price_html', $price_html, $product, $pricing_label, \true, \false);
                    // restore the original values
                    Product::variable_product_unsync($product);
                    // other product types
                } elseif ($measurement = Product::get_product_measurement($product, $settings)) {
                    // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.FoundInControlStructure
                    $measurement->set_unit($settings->get_pricing_unit());
                    if ($measurement && '' !== $price_html && $measurement->get_value()) {
                        // save the original price and remove the filter that we're currently within, to avoid an infinite loop
                        $original_prices = ['price' => $product->get_price(), 'regular_price' => $product->get_regular_price(), 'sale_price' => $product->get_sale_price()];
                        // calculate the price per unit, then format it
                        $new_prices = ['price' => (float) $original_prices['price'] / $measurement->get_value(), 'regular_price' => (float) $original_prices['regular_price'] / $measurement->get_value()];
                        // ensure there is a sale price before trying to set / use it
                        // otherwise this will result in warnings with PHP 7.1+
                        if (!empty($original_prices['sale_price'])) {
                            $new_prices['sale_price'] = (float) $original_prices['sale_price'] / $measurement->get_value();
                        }
                        // save new prices with WC 3.x compatibility
                        $product->set_props($new_prices);
                        $product = apply_filters('fq_price_calculator_quantity_price_per_unit', $product, $measurement);
                        // get price suffix
                        $price_suffix = $product->get_price_suffix();
                        // remove it from the price html
                        add_filter('woocommerce_get_price_suffix', '__return_empty_string');
                        // get the appropriate price html
                        $price_html = $product->get_price_html();
                        // re-add price suffix
                        remove_filter('woocommerce_get_price_suffix', '__return_empty_string');
                        // restore the original product price and price_html filters (WC 3.x compatibility)
                        $product->set_props($original_prices);
                        $pricing_label = $settings->get_pricing_label();
                        // add units
                        $price_html .= ' ' . $pricing_label;
                        // add price suffix
                        $price_html .= $price_suffix;
                        /** This filter is documented in /src/class-wc-price-calculator-product.php */
                        $price_html = (string) apply_filters('fq_price_calculator_get_price_html', $price_html, $product, $pricing_label, \true, \false);
                    }
                }
                // pricing calculator
            } elseif ($settings->pricing_rules_enabled()) {
                // pricing rules product
                $price_html = Product::get_pricing_rules_price_html($product, $settings);
            } elseif ('' !== $price_html) {
                $pricing_label = $settings->get_pricing_label();
                // $price_html = wc_price( 123 );
                // normal pricing calculator non-empty price: add units
                $price_html .= ' ' . $pricing_label;
                // add price suffix
                $price_html .= $product->get_price_suffix();
                if ($_product->is_on_sale()) {
                    $price_html = Product::get_price_html_from_to($_product->get_regular_price(), $_product->get_sale_price(), $pricing_label);
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
