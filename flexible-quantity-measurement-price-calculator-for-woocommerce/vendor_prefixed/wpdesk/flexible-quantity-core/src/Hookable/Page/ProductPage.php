<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Page;

use WDFQVendorFree\WPDesk\View\Renderer\Renderer;
use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Product;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Settings;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Measurement;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\SettingsContainer;
class ProductPage implements Hookable
{
    /**
     * @var SettingsContainer
     */
    private SettingsContainer $settings_container;
    /**
     * @var Renderer
     */
    private $renderer;
    private const MEASUREMENT_PRECISION = 3;
    public function __construct(SettingsContainer $settings_container, Renderer $renderer)
    {
        $this->settings_container = $settings_container;
        $this->renderer = $renderer;
    }
    public function hooks()
    {
        // simple product.
        add_action('woocommerce_before_add_to_cart_button', [$this, 'render_single'], 5);
        // variation product.
        add_action('woocommerce_single_variation', [$this, 'render_variable'], 15);
    }
    public function render_single(): void
    {
        global $product;
        if (!$product->is_type('simple')) {
            return;
        }
        echo $this->render();
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
    public function render_variable(): void
    {
        global $product;
        $settings = $this->settings_container->get($product);
        if (!$settings->is_calculator_enabled()) {
            return;
        }
        $this->renderer->output_render('single-product/price-calculator-variable');
    }
    public function render(): string
    {
        global $product;
        $settings = $this->settings_container->get($product);
        if (!$settings->is_calculator_enabled()) {
            return '';
        }
        // get the product total measurement (ie Area or Volume, etc).
        $product_measurement = Product::get_product_measurement($product, $settings);
        if (!$product_measurement) {
            return '';
        }
        $product_measurement->set_unit($settings->get_pricing_unit());
        $measurements = $settings->get_calculator_measurements();
        if (count($measurements) === 0) {
            return '';
        }
        // get the first measurement.
        [$measurement] = $measurements;
        $product_measurement->set_common_unit($measurement->get_unit_common());
        $total_amount_text = apply_filters('fq_price_calculator_total_amount_text', $product_measurement->get_unit_label() ? sprintf(__('Total %1$s (%2$s)', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), $product_measurement->get_label(), __($product_measurement->get_unit_label(), 'flexible-quantity-measurement-price-calculator-for-woocommerce')) : sprintf(__('Total %s', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), $product_measurement->get_label()), $product);
        return $this->renderer->render('single-product/price-calculator', ['product' => $product, 'total_amount_text' => $total_amount_text, 'product_measurement' => $product_measurement, 'settings' => $settings, 'measurements' => $measurements, 'controller' => $this]);
    }
    public function render_single_measurement_field(Measurement $measurement, Settings $settings): void
    {
        $measurement_name = $measurement->get_name() . '_needed';
        $input_attributes = $settings->get_input_attributes($measurement->get_name());
        $help_text = '';
        if (empty($input_attributes)) {
            $decimal_separator = trim(\wc_get_price_decimal_separator());
            $thousand_separator = trim(\wc_get_price_thousand_separator());
            $format_example = "1{$thousand_separator}234{$decimal_separator}56";
            /* translators: Placeholder: %s - format example */
            $help_text = sprintf(__('Please enter the desired amount with this format: %s', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), $format_example);
        }
        $this->renderer->output_render('single-product/single-measurement-field', ['measurement' => $measurement, 'measurement_name' => $measurement_name, 'measurement_value' => $this->get_measurement_value($measurement_name, $input_attributes, $measurement->get_default_value()), 'attributes' => $this->get_attributes($input_attributes), 'help_text' => $help_text]);
    }
    private function get_attributes(array $input_attributes): array
    {
        if (empty($input_attributes)) {
            return [];
        }
        $attributes = [];
        if (!isset($input_attributes['step'])) {
            /**
             * Filters the measurement precision.
             *
             * @param int $measurement_precision the measurement precision
             *
             * @since 3.0
             */
            $measurement_precision = \apply_filters('fq_price_calculator_measurement_precision', self::MEASUREMENT_PRECISION);
            $input_attributes['step'] = pow(10, -$measurement_precision);
        }
        if (!isset($input_attributes['min'])) {
            $input_attributes['min'] = 0;
        }
        // convert to HTML attributes.
        foreach ($input_attributes as $key => $value) {
            $attributes[] = $key . '="' . esc_attr($value) . '"';
        }
        return $attributes;
    }
    private function get_measurement_value(string $measurement_name, array $input_attributes, string $default_value): string
    {
        if (isset($_POST[$measurement_name])) {
            // phpcs:ignore WordPress.Security.NonceVerification
            return \wc_clean(\wp_unslash($_POST[$measurement_name]));
            // phpcs:ignore WordPress.Security.NonceVerification
        }
        if (isset($input_attributes['step']) && is_numeric($input_attributes['step'])) {
            $default_value = $input_attributes['step'];
        }
        if (isset($input_attributes['min']) && is_numeric($input_attributes['min'])) {
            $default_value = $input_attributes['min'];
        }
        /**
         * Filters the default measurement value.
         *
         * @param string $default_value the default measurement value
         * @param string $measurement_name the measurement name
         * @param array $input_attributes the input attributes
         *
         * @since 2.1.0
         */
        return apply_filters('fq_price_calculator_measurement_default_value', $default_value, $measurement_name, $input_attributes);
    }
}
