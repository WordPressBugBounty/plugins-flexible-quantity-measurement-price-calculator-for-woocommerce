<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Quantity;

use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\SettingsContainer;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Product;
use WC_Product;
class CartQuantityValidator implements Hookable
{
    private SettingsContainer $settings_container;
    public function __construct(SettingsContainer $settings_container)
    {
        $this->settings_container = $settings_container;
    }
    public function hooks()
    {
        add_filter('woocommerce_add_to_cart_validation', [$this, 'validate_add_to_cart_quantity'], 10, 6);
        add_filter('woocommerce_update_cart_validation', [$this, 'validate_cart_update_quantity'], 10, 4);
    }
    /**
     * @param bool $passed
     * @param int $product_id
     * @param int|float|string $quantity
     * @param int|string $variation_id
     * @param array<string, mixed> $variation
     * @param array<string, mixed> $cart_item_data
     * @return bool
     */
    public function validate_add_to_cart_quantity($passed, $product_id, $quantity, $variation_id = 0, $variation = [], $cart_item_data = []): bool
    {
        $product = wc_get_product($variation_id ? $variation_id : $product_id);
        return $this->validate_quantity($passed, $product, $quantity);
    }
    /**
     * @param bool $passed
     * @param string $cart_item_key
     * @param array<string, mixed> $values
     * @param int|float|string $quantity
     * @return bool
     */
    public function validate_cart_update_quantity($passed, $cart_item_key, $values, $quantity): bool
    {
        $product = $values['data'] ?? null;
        return $this->validate_quantity($passed, $product, $quantity);
    }
    /**
     * @param bool $passed
     * @param mixed $product
     * @param int|float|string $quantity
     * @return bool
     */
    private function validate_quantity($passed, $product, $quantity): bool
    {
        if (!$passed || !$product instanceof WC_Product || !is_numeric($quantity)) {
            return $passed;
        }
        $quantity = (float) $quantity;
        if ($quantity === floor($quantity)) {
            return $passed;
        }
        $settings = $this->settings_container->get($product);
        if (Product::pricing_calculator_enabled($product, $settings)) {
            return $passed;
        }
        wc_add_notice(__('Please enter a whole-number quantity for this product.', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'error');
        return \false;
    }
}
