<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services;

use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\PostType\FQTemplateType;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Settings\TemplatePageSaver;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Settings;
/**
 * Finds template for a given product
 */
class TemplateFinder
{
    /**
     * @var bool
     */
    private $is_locked;
    public function __construct(bool $is_locked)
    {
        $this->is_locked = $is_locked;
    }
    public function get(\WC_Product $product): int
    {
        $template_id = $this->get_template_by_product_id($product->get_id());
        if ($template_id > 0) {
            return $template_id;
        }
        if ($product instanceof \WC_Product_Variable && !$this->is_locked) {
            $template_id = $this->get_template_by_meta_key('product_id', $product->get_children());
        }
        if ($product instanceof \WC_Product_Variation && !$this->is_locked) {
            $template_id = $this->get_template_by_product_id($product->get_parent_id());
        }
        if ($template_id > 0) {
            return $template_id;
        }
        $categories = $this->get_categories($product);
        $template_id = $this->get_template_by_meta_key('category_id', $categories);
        if ($template_id > 0) {
            return $template_id;
        }
        $tags = $this->get_tags($product);
        $template_id = $this->get_template_by_meta_key('tag_id', $tags);
        if ($template_id > 0) {
            return $template_id;
        }
        return 0;
    }
    /**
     * Search template by its settings.
     * This is needed to redirect old FQ product settings
     * and create templates for them.
     *
     * @param array<string, mixed> $settings
     * @return int
     */
    public function get_by_settings(array $settings): int
    {
        $args = ['post_type' => FQTemplateType::POST_TYPE, 'meta_query' => ['relation' => 'AND', ['key' => Settings::SETTINGS_META_KEY . '_hash', 'value' => md5(\wp_json_encode($settings))], ['key' => TemplatePageSaver::SELECTION_CATEGORY_META_KEY, 'value' => 'products']]];
        $query = new \WP_Query($args);
        if ($query->post_count > 0) {
            return $query->posts[0]->ID;
        }
        return 0;
    }
    private function get_template_by_product_id(int $product_id): int
    {
        $args = ['post_type' => FQTemplateType::POST_TYPE, 'post_status' => 'publish', 'meta_query' => [['key' => 'product_id', 'value' => $product_id]]];
        $query = new \WP_Query($args);
        if ($query->post_count > 0) {
            return $query->posts[0]->ID;
        }
        return 0;
    }
    /**
     * @param string $meta_key
     * @param array<int> $meta_values
     * @return int
     */
    private function get_template_by_meta_key(string $meta_key, array $meta_values): int
    {
        if (count($meta_values) === 0) {
            return 0;
        }
        $args = ['post_type' => FQTemplateType::POST_TYPE, 'post_status' => 'publish', 'meta_query' => [['key' => $meta_key, 'value' => $meta_values, 'compare' => 'IN']]];
        $query = new \WP_Query($args);
        if ($query->post_count > 0) {
            return $query->posts[0]->ID;
        }
        return 0;
    }
    /**
     * @param \WC_Product $product
     * @return array<int>
     */
    private function get_categories(\WC_Product $product): array
    {
        if ($product instanceof \WC_Product_Variation) {
            $parent_product = \wc_get_product($product->get_parent_id());
            return $parent_product->get_category_ids();
        }
        return $product->get_category_ids();
    }
    /**
     * @param \WC_Product $product
     * @return array<int>
     */
    private function get_tags(\WC_Product $product): array
    {
        if ($product instanceof \WC_Product_Variation) {
            $parent_product = \wc_get_product($product->get_parent_id());
            return $parent_product->get_tag_ids();
        }
        return $product->get_tag_ids();
    }
}
