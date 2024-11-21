<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Cart;

use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\SettingsContainer;
use WC_Product;
/**
 * Modifies quantity in cart context.
 */
class QuantityModifier implements Hookable
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
        \add_filter('woocommerce_add_to_cart_sold_individually_quantity', [$this, 'add_to_cart_sold_individually_quantity'], 10, 5);
    }
    /**
     * Adjust the quantity for a sold individually option.
     * This is needed to get through the validation of
     * $product_data->has_enough_stock( $quantity )
     *
     * @param int $sold_individually_quantity this is 1
     * @param int|float $quantity already calculated quantity
     * @param int $product_id
     * @param int $variation_id
     * @param array<string, mixed> $cart_item_data
     *
     * @return float quantity
     */
    public function add_to_cart_sold_individually_quantity($sold_individually_quantity, $quantity, $product_id, $variation_id, $cart_item_data)
    {
        $product = \wc_get_product($product_id);
        if (!$product instanceof WC_Product) {
            return $sold_individually_quantity;
        }
        $settings = $this->settings_container->get($product);
        if (!$settings->is_calculator_enabled()) {
            return $sold_individually_quantity;
        }
        if (!isset($cart_item_data['pricing_item_meta_data'])) {
            return $sold_individually_quantity;
        }
        return (float) $cart_item_data['pricing_item_meta_data']['_measurement_needed'];
    }
}
