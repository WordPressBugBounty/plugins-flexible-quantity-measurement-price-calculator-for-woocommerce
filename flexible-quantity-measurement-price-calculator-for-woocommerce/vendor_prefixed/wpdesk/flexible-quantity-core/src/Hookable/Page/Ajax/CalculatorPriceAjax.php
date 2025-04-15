<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Page\Ajax;

use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\SettingsContainer;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Prices\PriceModifier;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Page\ProductPageScripts;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Calculator\PriceCalculator;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Validator\MeasurementValidator;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Calculator\MeasurementCalculator;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Validator\IncrementValidator;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Validator\InRangeValidator;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Validator\PositiveNumberValidator;
class CalculatorPriceAjax implements Hookable
{
    /**
     * @var SettingsContainer
     */
    private SettingsContainer $settings_container;
    /**
     * @var PriceModifier
     */
    private $price_modifier;
    public const ACTION = 'price_calculation';
    public function __construct(SettingsContainer $settings_container, PriceModifier $price_modifier)
    {
        $this->settings_container = $settings_container;
        $this->price_modifier = $price_modifier;
    }
    public function hooks()
    {
        \add_action('wp_ajax_' . self::ACTION, [$this, 'price_calculation']);
        \add_action('wp_ajax_nopriv_' . self::ACTION, [$this, 'price_calculation']);
    }
    public function price_calculation()
    {
        if (!isset($_POST['nonce']) || !\wp_verify_nonce(\sanitize_key(\wp_unslash($_POST['nonce'])), ProductPageScripts::NONCE_CONTEXT)) {
            \wp_send_json_error('Invalid nonce');
        }
        $product_id = \sanitize_key($_POST['product_id'] ?? 0);
        $form_data = \wc_clean(\wp_unslash($_POST['form_data'] ?? []));
        // form_data is passed in as a query string, parse it to an array.
        parse_str($form_data, $form_data);
        $product = \wc_get_product($product_id);
        if (!$product instanceof \WC_Product) {
            \wp_send_json_error('Invalid product');
        }
        $settings = $this->settings_container->get($product);
        $measurements = $settings->get_calculator_measurements();
        // setup the measurements values.
        foreach ($measurements as $measurement) {
            $value = (float) $form_data[$measurement->get_name() . '_needed'] ?? 0;
            $measurement->set_value($value);
        }
        $validator = new MeasurementValidator(new PositiveNumberValidator(), new InRangeValidator($settings), new IncrementValidator($settings));
        $result = $validator->validate($measurements);
        if (!$result->is_valid()) {
            \wp_send_json_error($result->get_errors());
        }
        $measurement_calculator = new MeasurementCalculator($settings);
        $measurement = $measurement_calculator->calculate($measurements);
        $price_calculator = new PriceCalculator($settings);
        $price = $price_calculator->calculate($measurement, (float) $product->get_price());
        $product->set_price($price);
        $this->price_modifier->unhooks();
        $price_html = \wc_price(\wc_get_price_to_display($product));
        $this->price_modifier->hooks();
        $response = ['price_html' => \wp_kses_post($price_html), 'price' => $price, 'measurement_needed' => $measurement->get_value($settings->get_pricing_unit()), 'measurement_needed_unit' => $settings->get_pricing_unit()];
        \wp_send_json_success($response);
    }
}
