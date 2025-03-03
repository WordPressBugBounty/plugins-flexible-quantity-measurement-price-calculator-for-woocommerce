<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Settings;

use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable;
class ProductPageScripts implements Hookable
{
    private string $assets_url;
    private string $version;
    public function __construct(string $assets_url, string $version)
    {
        $this->assets_url = $assets_url;
        $this->version = $version;
    }
    public function hooks(): void
    {
        add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_scripts'], 15);
    }
    final public function admin_enqueue_scripts(): void
    {
        global $post;
        if (!$post instanceof \WP_Post || $post->post_type !== 'product') {
            return;
        }
        wp_enqueue_style('fq-product-admin', $this->assets_url . '/css/product.css', [], $this->version);
        wp_enqueue_script('fq-product-admin', $this->assets_url . '/js/product.js', ['jquery'], $this->version);
    }
}
