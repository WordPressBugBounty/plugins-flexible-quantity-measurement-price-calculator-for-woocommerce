<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Settings\Ajax;

use WDFQVendorFree\WPDesk\View\Renderer\Renderer;
use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Units;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\SettingsBagFactory;
use WDFQVendorFree\WPDesk\Persistence\Adapter\WordPress\WordpressPostMetaContainer;
class DimensionsAjax implements Hookable
{
    /**
     * @var Renderer
     */
    private $renderer;
    public const ACTION = 'get_dimensions';
    public const NONCE_CONTEXT = 'fq_admin_nonce';
    public function __construct(Renderer $renderer)
    {
        $this->renderer = $renderer;
    }
    public function hooks()
    {
        add_action('wp_ajax_' . self::ACTION, [$this, 'get_dimensions']);
    }
    public function get_dimensions()
    {
        if (!isset($_POST['nonce']) || !\wp_verify_nonce($_POST['nonce'], self::NONCE_CONTEXT)) {
            \wp_send_json_error('Invalid nonce');
        }
        if (!isset($_POST['template_id'])) {
            \wp_send_json_error('Required field "template_id" is not set');
        }
        $template_id = \sanitize_key($_POST['template_id']);
        $unit = \wc_clean($_POST['unit'] ?? '');
        $settings = (new SettingsBagFactory(new WordpressPostMetaContainer($template_id)))->create();
        $unit = empty($unit) ? $settings->bag('fq')->getString('unit') : $unit;
        $calculator_type = Units::get_calculator_type($unit);
        $units = Units::get_unit_options($unit);
        $content = '';
        $dimension_definition = $this->get_dimensions_definition_by_calculator_type($calculator_type);
        foreach ($dimension_definition as $dimension_slug => $dimension) {
            $content .= $this->renderer->render('settings/dimensions/dimension-row', ['dimension_slug' => $dimension_slug, 'type_field_label' => $dimension['label'], 'settings' => $settings->bag('fq')->bag('decimals')->bag($dimension_slug), 'units' => $units]);
        }
        \wp_send_json_success(['content' => $content]);
    }
    private function get_dimensions_definition_by_calculator_type(string $calculator_type): array
    {
        $dimension_definitions = ['weight' => ['label' => __('Weight', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'calculator_type' => ['weight']], 'length' => ['label' => __('Length', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'calculator_type' => ['dimension', 'area', 'volume-dimension']], 'width' => ['label' => __('Width', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'calculator_type' => ['area', 'volume-dimension']], 'height' => ['label' => __('Height', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'calculator_type' => ['volume-dimension']], 'volume' => ['label' => __('Volume', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'calculator_type' => ['volume']], 'other' => ['label' => __('Other', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'calculator_type' => ['other']]];
        return \array_filter($dimension_definitions, function ($dimension) use ($calculator_type) {
            return in_array($calculator_type, $dimension['calculator_type'], \true);
        });
    }
}
