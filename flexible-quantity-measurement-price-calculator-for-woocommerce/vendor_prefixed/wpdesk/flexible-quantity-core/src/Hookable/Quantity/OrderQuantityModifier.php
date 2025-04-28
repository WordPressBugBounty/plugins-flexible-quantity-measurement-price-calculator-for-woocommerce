<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Quantity;

use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\SettingsContainer;
use WC_Product;
class OrderQuantityModifier implements Hookable
{
    private const DEFAULT_STEP_FOR_CALCULATE_INVENTORY = '0.0001';
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
        add_filter('woocommerce_order_item_get_quantity', [$this, 'get_quantity'], 10, 2);
        add_filter('woocommerce_quantity_input_step_admin', [$this, 'admin_quantity_input_step'], 10, 2);
    }
    /**
     * Hook to modify order item quantity.
     *
     * @param string $quanity
     * @param \WC_Order_Item_Product $order_item_product
     * @return string
     */
    public function get_quantity($quanity, $order_item_product)
    {
        $product = $order_item_product->get_product();
        if (!$product instanceof WC_Product) {
            return $quanity;
        }
        $settings = $this->settings_container->get($product);
        if (!$settings->is_calculator_enabled()) {
            return $quanity;
        }
        if (!$settings->is_pricing_inventory_enabled()) {
            return $quanity;
        }
        if (!isset($order_item_product->get_meta('_fq_measurement_data')['_measurement_needed'])) {
            return $quanity;
        }
        $measurement_needed = (float) $order_item_product->get_meta('_fq_measurement_data')['_measurement_needed'];
        $quanity = (int) $quanity;
        return (string) ($quanity * $measurement_needed);
    }
    /**
     * Adjust the quantity step based on the product settings.
     *
     * @param string $step The quantity step.
     * @param WC_Product $product The product.
     * @return string
     */
    public function admin_quantity_input_step($step, $product)
    {
        $settings = $this->settings_container->get($product);
        if (!$settings->is_calculator_enabled()) {
            return $step;
        }
        if (!$settings->is_pricing_inventory_enabled()) {
            return $step;
        }
        $increment = $settings->get_basic_increment();
        return $increment !== '' ? $increment : self::DEFAULT_STEP_FOR_CALCULATE_INVENTORY;
    }
}
