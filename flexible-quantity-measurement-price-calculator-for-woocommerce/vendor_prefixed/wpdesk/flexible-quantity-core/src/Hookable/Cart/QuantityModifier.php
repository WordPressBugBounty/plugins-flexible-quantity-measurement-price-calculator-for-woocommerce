<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Cart;

use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\SettingsContainer;
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
        \add_filter('woocommerce_add_to_cart_quantity', [$this, 'add_to_cart_quantity'], 10, 2);
        \add_filter('woocommerce_add_to_cart_sold_individually_quantity', [$this, 'add_to_cart_sold_individually_quantity'], 10, 3);
    }
    /**
     * Modifies quantity when calculate inventory option is enabled.
     *
     * @param float $quantity  basic (WC) quantity being added to the cart
     * @param int   $product_id
     *
     * @return float updated quantity
     */
    public function add_to_cart_quantity($quantity, $product_id)
    {
        $product = \wc_get_product($product_id);
        if (!$product instanceof \WC_Product) {
            return $quantity;
        }
        $settings = $this->settings_container->get($product);
        if (!$settings->is_pricing_inventory_enabled()) {
            return $quantity;
        }
        // measurement needed in pricing units.
        if (!isset($_REQUEST['_measurement_needed'])) {
            return $quantity;
        }
        return $quantity * (float) $_REQUEST['_measurement_needed'];
    }
    /**
     * Adjust the quantity for a sold individually option.
     * This option no longer has its full original meaning.
     * Example: When calculating inventory is enabled, then sold individually is
     * used only to hide original quantity from the cart.
     *
     * @param int $sold_individually_quantity this is 1
     * @param int|float $quantity already calculated quantity
     * @param int $product_id
     *
     * @return float quantity
     */
    public function add_to_cart_sold_individually_quantity($sold_individually_quantity, $quantity, $product_id)
    {
        $product = \wc_get_product($product_id);
        if (!$product instanceof \WC_Product) {
            return $sold_individually_quantity;
        }
        $settings = $this->settings_container->get($product);
        if (!$settings->is_pricing_inventory_enabled()) {
            return $sold_individually_quantity;
        }
        return $quantity;
    }
}
