<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Page;

use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\SettingsContainer;
class ProductPageScripts implements \WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable
{
    /**
     * @var SettingsContainer
     */
    private $settings_container;
    /**
     * @var string
     */
    private $assets_url;
    /**
     * @var string
     */
    private $script_version;
    public const NONCE_CONTEXT = 'fq_calculator_nonce';
    public function __construct(\WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\SettingsContainer $settings_container, string $assets_url, string $script_version)
    {
        $this->settings_container = $settings_container;
        $this->assets_url = $assets_url;
        $this->script_version = $script_version;
    }
    public function hooks()
    {
        \add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
    }
    /**
     * Enqueue scripts
     */
    public function enqueue_scripts()
    {
        if (!\is_product()) {
            return;
        }
        $product = \wc_get_product(\get_the_ID());
        if (!$product instanceof \WC_Product) {
            return;
        }
        $settings = $this->settings_container->get($product);
        if (!$settings->is_calculator_enabled()) {
            return;
        }
        \wp_enqueue_script('fq-front', $this->assets_url . '/js/front.js', ['jquery'], $this->script_version);
        \wp_localize_script('fq-front', 'fq_price_calculator_params', ['ajax_url' => \admin_url('admin-ajax.php'), 'product_id' => $product->get_id(), 'product_type' => $product->get_type(), 'nonce' => \wp_create_nonce(self::NONCE_CONTEXT)]);
    }
}
