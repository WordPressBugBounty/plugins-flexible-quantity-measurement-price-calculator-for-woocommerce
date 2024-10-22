<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Prices;

use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Measurement;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\SettingsContainer;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Calculator\PriceCalculator;
/**
 * Override woocommerce product price with FQ price.
 *
 * FQ Prices in general:
 * 1. Before add to cart (regular product) - price from FQ settings (template)
 * 2. After add to cart (product item) - price calculated based on mesurements (quantity)
 */
class PriceModifier implements Hookable
{
    /**
     * @var SettingsContainer
     */
    private $settings_container;
    /**
     * @var bool
     */
    private $inside_calulate_totals = \false;
    public function __construct(SettingsContainer $settings_container)
    {
        $this->settings_container = $settings_container;
    }
    public function hooks()
    {
        // regular products.
        \add_filter('woocommerce_product_get_price', [$this, 'get_price'], 10, 2);
        \add_filter('woocommerce_product_get_regular_price', [$this, 'get_regular_price'], 10, 2);
        \add_filter('woocommerce_product_get_sale_price', [$this, 'get_sale_price'], 10, 2);
        // product variations.
        \add_filter('woocommerce_product_variation_get_price', [$this, 'get_price'], 10, 2);
        \add_filter('woocommerce_product_variation_get_regular_price', [$this, 'get_regular_price'], 10, 2);
        \add_filter('woocommerce_product_variation_get_sale_price', [$this, 'get_sale_price'], 10, 2);
        // products in cart do not have prices set, we have to set it on the fly.
        // firstly, when product is added to cart.
        \add_filter('woocommerce_add_cart_item', [$this, 'add_cart_item'], 1, 1);
        // and then, when product is grabbed from session.
        \add_filter('woocommerce_get_cart_item_from_session', [$this, 'get_cart_item_from_session'], 10, 2);
        // displayed prices.
        \add_filter('woocommerce_variation_prices_price', [$this, 'get_price'], 10, 2);
        \add_filter('woocommerce_variation_prices_regular_price', [$this, 'get_regular_price'], 10, 2);
        \add_filter('woocommerce_variation_prices_sale_price', [$this, 'get_sale_price'], 10, 2);
        // some strange price calculations (backward compatibility).
        \add_action('woocommerce_before_calculate_totals', [$this, 'woocommerce_before_calculate_totals'], 10, 1);
        \add_action('woocommerce_after_calculate_totals', [$this, 'woocommerce_after_calculate_totals'], 10, 1);
        \add_filter('woocommerce_cart_item_subtotal', [$this, 'woocommerce_cart_item_subtotal'], 10, 3);
    }
    public function unhooks()
    {
        \remove_filter('woocommerce_product_get_price', [$this, 'get_price'], 10, 2);
        \remove_filter('woocommerce_product_get_regular_price', [$this, 'get_regular_price'], 10, 2);
        \remove_filter('woocommerce_product_get_sale_price', [$this, 'get_sale_price'], 10, 2);
        // product variations
        \remove_filter('woocommerce_product_variation_get_price', [$this, 'get_price'], 10, 2);
        \remove_filter('woocommerce_product_variation_get_regular_price', [$this, 'get_regular_price'], 10, 2);
        \remove_filter('woocommerce_product_variation_get_sale_price', [$this, 'get_sale_price'], 10, 2);
    }
    /**
     * Sets woocommerce prices for cart items from the session.
     *
     * @param array $session_item_data
     * @param array $values
     */
    public function get_cart_item_from_session($session_item_data, $values)
    {
        if (!$session_item_data['data'] instanceof \WC_Product) {
            return $session_item_data;
        }
        // this is set when product is added with calculator.
        if (!isset($values['pricing_item_meta_data']['_price'])) {
            return $session_item_data;
        }
        $session_item_data['data']->set_price($values['pricing_item_meta_data']['_price']);
        $session_item_data['data']->update_meta_data('has_price_calculated', \true);
        $session_item_data['data']->update_meta_data('quantity', $values['quantity']);
        $session_item_data['data']->update_meta_data('measurement_needed', $values['pricing_item_meta_data']['_measurement_needed']);
        return $session_item_data;
    }
    /**
     * Sets woocommerce prices for cart items, when product is added to cart.
     *
     * @param array $cart_item
     */
    public function add_cart_item($cart_item)
    {
        if (!$cart_item['data'] instanceof \WC_Product) {
            return $cart_item;
        }
        if (!isset($cart_item['pricing_item_meta_data']['_price'])) {
            return $cart_item;
        }
        $cart_item['data']->set_price($cart_item['pricing_item_meta_data']['_price']);
        $cart_item['data']->update_meta_data('has_price_calculated', \true);
        $cart_item['data']->update_meta_data('quantity', $cart_item['quantity']);
        $cart_item['data']->update_meta_data('measurement_needed', $cart_item['pricing_item_meta_data']['_measurement_needed']);
        return $cart_item;
    }
    public function get_price($price, $product)
    {
        $settings = $this->settings_container->get($product);
        if (!$settings->is_calculator_enabled()) {
            return $price;
        }
        $has_price_calculated = $product->get_meta('has_price_calculated', \true);
        if ($has_price_calculated !== \true) {
            $price = $settings->get_price();
        }
        if (!$settings->is_pricing_inventory_enabled() || !$this->inside_calulate_totals) {
            return $price;
        }
        $quantity = (int) $product->get_meta('quantity', \true);
        if ($quantity === 0) {
            return $price;
        }
        $measurement_needed = (float) $product->get_meta('measurement_needed', \true);
        if ($measurement_needed === 0) {
            return $price;
        }
        $total_quantity = $quantity * $measurement_needed;
        $measurement = new Measurement($settings->get_pricing_unit(), $total_quantity);
        $rule_price = $settings->get_pricing_rules_price($measurement);
        return $rule_price > 0 ? (float) $rule_price * $measurement_needed : $price;
    }
    public function woocommerce_before_calculate_totals($cart)
    {
        $this->inside_calulate_totals = \true;
        return $cart;
    }
    public function woocommerce_after_calculate_totals($cart)
    {
        $this->inside_calulate_totals = \false;
        return $cart;
    }
    public function woocommerce_cart_item_subtotal($subtotal, $cart_item, $cart_item_key)
    {
        $this->inside_calulate_totals = \true;
        $subtotal = \WC()->cart->get_product_subtotal($cart_item['data'], $cart_item['quantity']);
        $this->inside_calulate_totals = \false;
        return $subtotal;
    }
    public function get_regular_price($price, $product)
    {
        $settings = $this->settings_container->get($product);
        if ($settings->is_calculator_enabled()) {
            $price = $settings->get_regular_price();
        }
        return $price;
    }
    public function get_sale_price($price, $product)
    {
        $settings = $this->settings_container->get($product);
        if ($settings->is_calculator_enabled()) {
            $price = $settings->get_sale_price();
        }
        return $price;
    }
}
