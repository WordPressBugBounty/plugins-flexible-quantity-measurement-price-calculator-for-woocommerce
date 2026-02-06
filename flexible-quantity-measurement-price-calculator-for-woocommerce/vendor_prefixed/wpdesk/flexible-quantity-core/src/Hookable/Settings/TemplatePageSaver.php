<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Settings;

use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Settings;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\TemplatePersistentContainer;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\PostType\FQTemplateType;
class TemplatePageSaver implements Hookable
{
    public const NONCE_ACTION = 'fq_save_template_nonce';
    public const NONCE_NAME = 'fq_nonce';
    public const SELECTION_CATEGORY_META_KEY = 'selection_category';
    public function hooks(): void
    {
        \add_action('save_post_' . FQTemplateType::POST_TYPE, [$this, 'save'], 10, 2);
    }
    public function save(int $post_id, \WP_Post $post): void
    {
        if (!isset($_POST[self::NONCE_NAME], $_POST['fq_selection_category'], $_POST['fq']) || !is_array($_POST['fq'])) {
            return;
        }
        if (!\wp_verify_nonce(\sanitize_key($_POST[self::NONCE_NAME]), self::NONCE_ACTION)) {
            return;
        }
        if ($post->post_type !== FQTemplateType::POST_TYPE) {
            return;
        }
        $selection_category = \sanitize_text_field(\wp_unslash($_POST['fq_selection_category']));
        $selections = \array_filter(\wc_clean(\wp_unslash($_POST['fq_selections'] ?? [])), 'is_numeric');
        $raw_settings = ['fq' => \wc_clean(\wp_unslash($_POST['fq']))];
        $container = new TemplatePersistentContainer($post_id);
        $container->set(Settings::SETTINGS_META_KEY, $raw_settings);
        $container->set(Settings::SETTINGS_META_KEY . '_hash', md5(\wp_json_encode($raw_settings)));
        $container->set(self::SELECTION_CATEGORY_META_KEY, $selection_category);
        $container->delete('product_id');
        $container->delete('category_id');
        $container->delete('tag_id');
        $meta_key = $this->get_selection_meta_key_by_category($selection_category);
        foreach ($selections as $selection_id) {
            $container->add($meta_key, $selection_id);
        }
        // This is needed to correctly display the product prices after template price setting changes
        $this->clear_affected_product_transients($selection_category, $selections);
    }
    private function get_selection_meta_key_by_category(string $selection_category): string
    {
        switch ($selection_category) {
            case 'products':
                return 'product_id';
            case 'product_categories':
                return 'category_id';
            case 'product_tags':
                return 'tag_id';
            default:
                return '';
        }
    }
    /**
     * Clear WooCommerce product transients for all products affected by template changes
     *
     * @param string $selection_category Type of selection (products, product_categories, product_tags)
     * @param array<int> $selections Array of selection IDs
     */
    private function clear_affected_product_transients(string $selection_category, array $selections): void
    {
        if (empty($selections)) {
            return;
        }
        $product_ids = [];
        switch ($selection_category) {
            case 'products':
                $product_ids = $selections;
                break;
            case 'product_categories':
                $args = ['post_type' => 'product', 'post_status' => 'publish', 'posts_per_page' => -1, 'fields' => 'ids', 'tax_query' => [['taxonomy' => 'product_cat', 'field' => 'term_id', 'terms' => $selections, 'operator' => 'IN']]];
                $query = new \WP_Query($args);
                $product_ids = array_map('intval', $query->posts);
                break;
            case 'product_tags':
                $args = ['post_type' => 'product', 'post_status' => 'publish', 'posts_per_page' => -1, 'fields' => 'ids', 'tax_query' => [['taxonomy' => 'product_tag', 'field' => 'term_id', 'terms' => $selections, 'operator' => 'IN']]];
                $query = new \WP_Query($args);
                $product_ids = array_map('intval', $query->posts);
                break;
        }
        // Remove duplicates and clear transients for each product
        $product_ids = array_unique($product_ids);
        foreach ($product_ids as $product_id) {
            if (function_exists('wc_delete_product_transients')) {
                wc_delete_product_transients($product_id);
            }
        }
    }
}
