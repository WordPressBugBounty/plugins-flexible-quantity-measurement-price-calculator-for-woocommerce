<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Stock;

use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\SettingsContainer;
use Exception;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Overwrite\CartStockValidator;
/**
 * Handles stock validation for products with flexible quantity measurements.
 *
 * When using calculation inventory options, the quantity needs to be multiplied by the measurement factor.
 * Since WooCommerce's native WC_Cart::add_to_cart() doesn't account for this, this class intercepts
 * the validation process to apply the necessary adjustments before stock checks.
 *
 * Previously attempted solutions using the woocommerce_add_to_cart_quantity filter proved problematic,
 * particularly with block-based cart and checkout functionality where early quantity adjustments
 * caused inconsistencies in the UI and calculations.
 */
class CartStockValidationInterceptor implements Hookable
{
    private SettingsContainer $settings_container;
    private bool $is_validation_bypassed = \false;
    public function __construct(SettingsContainer $settings_container)
    {
        $this->settings_container = $settings_container;
    }
    public function hooks()
    {
        // Validation.
        \add_filter('woocommerce_add_cart_item_data', [$this, 'validate_inventory_stock'], 20, 4);
        // Bypassing validation within add_to_cart() method
        \add_filter('woocommerce_add_cart_item_data', [$this, 'bypass_stock_validation'], 100);
        \add_action('woocommerce_add_to_cart', [$this, 'restore_stock_validation'], 10);
    }
    /**
     * @param array<string, mixed> $cart_item_data
     * @return array<string, mixed>
     */
    public function bypass_stock_validation($cart_item_data)
    {
        if ($this->is_validation_bypassed) {
            \add_filter('woocommerce_product_get_manage_stock', '__return_false');
        }
        return $cart_item_data;
    }
    /**
     * @return void
     */
    public function restore_stock_validation()
    {
        if ($this->is_validation_bypassed) {
            \remove_filter('woocommerce_product_get_manage_stock', '__return_false');
        }
        $this->is_validation_bypassed = \false;
    }
    /**
     * @param array<string, mixed> $cart_item_data
     * @param int $product_id
     * @param int $variation_id
     * @param int $quantity
     * @return array<string, mixed>
     */
    public function validate_inventory_stock($cart_item_data, $product_id, $variation_id, $quantity)
    {
        $product = \wc_get_product($variation_id ? $variation_id : $product_id);
        if (!$product instanceof \WC_Product) {
            return $cart_item_data;
        }
        if (!$product->managing_stock()) {
            return $cart_item_data;
        }
        $settings = $this->settings_container->get($product);
        if (!$settings->is_pricing_inventory_enabled()) {
            return $cart_item_data;
        }
        $measurement_needed = isset($cart_item_data['pricing_item_meta_data']['_measurement_needed']) ? (float) $cart_item_data['pricing_item_meta_data']['_measurement_needed'] : null;
        if ($measurement_needed === null) {
            return $cart_item_data;
        }
        $quantity = $quantity * $measurement_needed;
        $stock_validator = new CartStockValidator();
        try {
            $stock_validator->validate_enough_stock($product, $quantity);
        } catch (Exception $e) {
            // rethrowing validation issues back to woocommerce.
            throw $e;
        }
        $this->is_validation_bypassed = \true;
        return $cart_item_data;
    }
}
