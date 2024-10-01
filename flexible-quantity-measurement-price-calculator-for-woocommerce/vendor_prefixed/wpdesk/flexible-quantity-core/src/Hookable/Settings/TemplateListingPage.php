<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Settings;

use WDFQVendorFree\WPDesk\View\Renderer\Renderer;
use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\PostType\FQTemplateType;
/**
 * Template listing admin page.
 */
class TemplateListingPage implements \WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable
{
    /**
     * @var Renderer
     */
    private $renderer;
    private const DELIMITER = ' | ';
    public function __construct(\WDFQVendorFree\WPDesk\View\Renderer\Renderer $renderer)
    {
        $this->renderer = $renderer;
    }
    public function hooks()
    {
        \add_filter('manage_' . \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\PostType\FQTemplateType::POST_TYPE . '_posts_columns', [$this, 'add_column'], 11);
        \add_action('manage_' . \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\PostType\FQTemplateType::POST_TYPE . '_posts_custom_column', [$this, 'get_value'], 10, 2);
    }
    public function add_column($columns)
    {
        $columns['assign_to'] = \__('Assign to', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
        return $columns;
    }
    public function get_value($column, $post_id)
    {
        switch ($column) {
            case 'assign_to':
                $product_ids = \get_post_meta($post_id, 'product_id', \false);
                if ($product_ids) {
                    $this->render_products($product_ids);
                }
                $category_ids = \get_post_meta($post_id, 'category_id', \false);
                if ($category_ids) {
                    $this->render_categories($category_ids);
                }
                $tag_ids = \get_post_meta($post_id, 'tag_id', \false);
                if ($tag_ids) {
                    $this->render_tags($tag_ids);
                }
                break;
        }
    }
    private function render_products(array $product_ids) : void
    {
        $this->renderer->output_render('settings/template-listing/assign-column', ['title' => \__('Products', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'names' => $this->get_product_names($product_ids)]);
    }
    private function render_categories(array $category_ids) : void
    {
        $this->renderer->output_render('settings/template-listing/assign-column', ['title' => \__('Categories', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'names' => $this->get_term_names('product_cat', $category_ids)]);
    }
    private function render_tags(array $tag_ids) : void
    {
        $this->renderer->output_render('settings/template-listing/assign-column', ['title' => \__('Tags', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'names' => $this->get_term_names('product_tag', $tag_ids)]);
    }
    private function get_product_names(array $product_ids) : string
    {
        return $this->reduce_to_string(\array_map('wc_get_product', $product_ids), fn($product) => $product->get_name());
    }
    private function get_term_names(string $taxonomy, array $term_ids) : string
    {
        return $this->reduce_to_string(\array_map(fn($term_id) => \get_term_by('id', $term_id, $taxonomy), $term_ids), fn($term) => $term->name);
    }
    /**
     * @template T
     *
     * @param T[] $collection
     * @param callable(T): string $fn
     *
     * @return string
     */
    private function reduce_to_string(array $collection, callable $fn) : string
    {
        return \trim(\array_reduce(\array_filter($collection, 'is_object'), fn($carry, $obj) => $carry . $fn($obj) . self::DELIMITER, ''), self::DELIMITER);
    }
}
