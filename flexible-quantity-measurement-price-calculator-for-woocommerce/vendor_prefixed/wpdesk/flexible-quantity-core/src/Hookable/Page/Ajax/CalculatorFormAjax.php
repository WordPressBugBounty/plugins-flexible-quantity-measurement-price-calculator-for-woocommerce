<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Page\Ajax;

use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Page\ProductPage;
use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Page\ProductPageScripts;
class CalculatorFormAjax implements Hookable
{
    /**
     * @var ProductPage
     */
    private $product_page;
    public const ACTION = 'calculator_form';
    public function __construct(ProductPage $product_page)
    {
        $this->product_page = $product_page;
    }
    public function hooks()
    {
        \add_action('wp_ajax_' . self::ACTION, [$this, 'calculator_form']);
        \add_action('wp_ajax_nopriv_' . self::ACTION, [$this, 'calculator_form']);
    }
    public function calculator_form()
    {
        global $product;
        if (!isset($_POST['nonce']) || !\wp_verify_nonce($_POST['nonce'], ProductPageScripts::NONCE_CONTEXT)) {
            \wp_send_json_error('Invalid nonce');
        }
        $variation_id = \sanitize_key($_POST['variation_id'] ?? 0);
        $product = \wc_get_product($variation_id);
        if (!$product instanceof \WC_Product) {
            \wp_send_json_error('Invalid variation');
        }
        $result = $this->product_page->render($product);
        \wp_send_json_success($result);
    }
}
