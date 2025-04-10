<?php

namespace WDFQVendorFree\WPDesk\Library\WPCoupons\Integration;

use WC_Coupon;
use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable;
use WDFQVendorFree\WPDesk\View\Renderer\Renderer;
/**
 * Displays documents on my account.
 */
class MyAccount implements Hookable
{
    const PRODUCT_TYPE = 'wpdesk_pdf_coupons';
    /**
     * @var Renderer
     */
    private $renderer;
    /**
     * @var PostMeta
     */
    private $postmeta;
    /**
     * @param Renderer $renderer
     * @param PostMeta $postmeta
     */
    public function __construct(Renderer $renderer, PostMeta $postmeta)
    {
        $this->renderer = $renderer;
        $this->postmeta = $postmeta;
    }
    /**
     * @return void|null
     */
    public function hooks()
    {
        add_action('woocommerce_view_order', [$this, 'view_documents']);
    }
    /**
     * @param int $order_id
     *
     * @internal You should not use this directly from another application
     */
    public function view_documents(int $order_id)
    {
        $order = wc_get_order($order_id);
        $data = [];
        $items = $order->get_items();
        foreach ($items as $item) {
            $product_id = $item->get_product_id();
            $is_coupon_item = 'yes' === $this->postmeta->get_private((int) $product_id, self::PRODUCT_TYPE);
            $is_disabled = \false;
            if ($item->get_variation_id()) {
                $is_disabled = 'yes' === $this->postmeta->get_private($item->get_variation_id(), 'flexible_coupon_disable_pdf', 'no');
            }
            if (!$is_coupon_item || $is_disabled) {
                continue;
            }
            $meta_coupon_name = 'fcpdf_order_item_' . $item->get_id() . '_coupon_id';
            $coupon_id = (int) $order->get_meta($meta_coupon_name);
            if (!$coupon_id) {
                $coupon_id = (int) $order->get_meta('_' . $meta_coupon_name);
            }
            $coupon = new WC_Coupon($coupon_id);
            $coupon_data = $this->postmeta->get_private($coupon_id, 'fcpdf_coupon_data', []);
            $coupon_code = $coupon->get_id() ? $coupon->get_code() : '';
            $download_url = $coupon->get_id() ? Helper::make_coupon_url($coupon_data) : '';
            if ($download_url && $coupon_code) {
                $data[] = ['product_name' => $item->get_name(), 'coupon_code' => $coupon_code, 'coupon_is_used' => $this->is_coupon_limit_reached($coupon), 'download_url' => $download_url];
            }
        }
        $this->renderer->output_render('html-account', ['coupons' => $data]);
        //phpcs:ignore
    }
    /**
     * @param WC_Coupon $coupon Coupon data.
     *
     * @return bool
     */
    private function is_coupon_limit_reached(WC_Coupon $coupon): bool
    {
        return $coupon->get_usage_limit() > 0 && $coupon->get_usage_count() >= $coupon->get_usage_limit();
    }
}
