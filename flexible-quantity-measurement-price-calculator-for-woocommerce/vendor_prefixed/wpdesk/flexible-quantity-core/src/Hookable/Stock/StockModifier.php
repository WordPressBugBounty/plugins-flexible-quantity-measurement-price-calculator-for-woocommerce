<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Stock;

use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\SettingsContainer;
/**
 * Modifies stocks calculations.
 */
class StockModifier implements Hookable
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
        \add_action('woocommerce_before_product_object_save', [$this, 'reset_stock_status_by_quantity'], 10, 1);
    }
    /**
     * Woocommerce sets stock status to 'outofstock' when our quantity is fractional and below 1, because it casts quantity to int.
     * There is no hook available to change that, so we have to rerun set_stock_status() with our own calculations.
     *
     * @param \WC_Product $product
     *
     * @return void
     */
    public function reset_stock_status_by_quantity($product): void
    {
        if (!$product->get_manage_stock()) {
            return;
        }
        // The problem only occurs with outofstock status.
        $changeset = $product->get_changes();
        if (!isset($changeset['stock_status']) || $changeset['stock_status'] !== 'outofstock') {
            return;
        }
        $settings = $this->settings_container->get($product);
        if (!$settings->is_calculator_enabled()) {
            return;
        }
        // See validate_props() function in WC_Product class.
        $stock_is_above_notification_threshold = (float) $product->get_stock_quantity() > (float) \get_option('woocommerce_notify_no_stock_amount', 0);
        $backorders_are_allowed = 'no' !== $product->get_backorders();
        if ($stock_is_above_notification_threshold) {
            $new_stock_status = 'instock';
        } elseif ($backorders_are_allowed) {
            $new_stock_status = 'onbackorder';
        } else {
            $new_stock_status = 'outofstock';
        }
        $product->set_stock_status($new_stock_status);
    }
}
