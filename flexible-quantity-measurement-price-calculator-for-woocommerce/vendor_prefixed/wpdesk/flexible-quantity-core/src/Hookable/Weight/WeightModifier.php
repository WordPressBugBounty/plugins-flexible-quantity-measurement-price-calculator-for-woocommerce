<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Weight;

use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Measurement;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\SettingsContainer;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Calculator\WeightCalculator;
/**
 * Modifies product weight for FQ products in cart.
 */
class WeightModifier implements Hookable
{
    /**
     * @var SettingsContainer
     */
    private SettingsContainer $settings_container;
    /**
     * @var WeightCalculator
     */
    private $weight_calculator;
    public function __construct(SettingsContainer $settings_container)
    {
        $this->settings_container = $settings_container;
    }
    public function hooks()
    {
        \add_filter('woocommerce_get_cart_item_from_session', [$this, 'get_cart_item_from_session'], 20, 2);
    }
    /**
     * Sets product weight for cart item.
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
        if (!isset($values['pricing_item_meta_data']['_measurement_needed'])) {
            return $session_item_data;
        }
        $product = $session_item_data['data'];
        $settings = $this->settings_container->get($product);
        $measurement = new Measurement($settings->get_pricing_unit(), (float) $values['pricing_item_meta_data']['_measurement_needed']);
        $calculated_weight = $this->get_weight_calculator($product)->calculate($measurement);
        $session_item_data['data']->set_weight($calculated_weight);
        return $session_item_data;
    }
    private function get_weight_calculator(\WC_Product $product): WeightCalculator
    {
        if ($this->weight_calculator instanceof WeightCalculator) {
            return $this->weight_calculator;
        }
        $settings = $this->settings_container->get($product);
        $weight_calculator = new WeightCalculator($settings->get_calculator_type(), $product->get_weight(), \get_option('woocommerce_weight_unit'));
        return $weight_calculator;
    }
}
