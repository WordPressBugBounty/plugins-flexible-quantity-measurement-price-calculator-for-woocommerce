<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Template\Selection\Options;

use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\PostType\FQTemplateType;
class ProductOptionsProvider extends OptionsProviderBase implements OptionsProvider
{
    /**
     * @var bool
     */
    private $is_locked;
    public function __construct(bool $is_locked)
    {
        $this->is_locked = $is_locked;
    }
    public function get_template_meta_key(): string
    {
        return 'product_id';
    }
    public function get_options(): array
    {
        global $wpdb;
        $prepered_query = $this->get_options_query();
        $options = $wpdb->get_results($prepered_query, \ARRAY_A);
        // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
        $total_records = $wpdb->get_var('SELECT FOUND_ROWS()');
        $response = $this->prepare_response($options, $total_records);
        return $response;
    }
    public function get_selected_options(int $template_id, int $pre_selected_product_id = 0): array
    {
        $selection = \get_post_meta($template_id, 'product_id', \false);
        if ($pre_selected_product_id > 0) {
            $selection[] = $pre_selected_product_id;
        }
        if (!is_array($selection)) {
            return [];
        }
        return \array_map(function ($product_id) {
            return ['text' => html_entity_decode(\get_the_title($product_id)), 'id' => $product_id];
        }, $selection);
    }
    private function get_options_query(): string
    {
        global $wpdb;
        $post_types = $this->is_locked ? "('product')" : "('product', 'product_variation')";
        $exclude_sql = $this->prepare_exclude_sql();
        $search_sql = $this->prepare_search_sql();
        return $wpdb->prepare("\n            SELECT SQL_CALC_FOUND_ROWS p.ID as id, p.post_title as text\n            FROM {$wpdb->posts} p\n            LEFT JOIN {$wpdb->posts} p2 ON p.post_parent = p2.ID\n            WHERE p.post_type IN {$post_types}\n\t\t\tAND p.post_status IN ('publish', 'draft', 'private', 'future', 'pending')\n            {$search_sql}\n\t\t\t{$exclude_sql}\n            ORDER BY\n                CASE\n                    WHEN p2.post_title IS NULL THEN p.post_title\n                    ELSE p2.post_title\n                END ASC,\n                p.post_parent ASC,\n                p.post_title ASC\n            LIMIT %d OFFSET %d\n        ", self::ITEMS_PER_PAGE, $this->get_offset());
    }
    private function prepare_exclude_sql(): string
    {
        $exclude_ids = $this->get_excluded_ids();
        if (count($exclude_ids) === 0) {
            return '';
        }
        $placeholders = array_fill(0, count($exclude_ids), '%d');
        $query = sprintf('AND p.ID NOT IN (%s)', implode(', ', $placeholders));
        global $wpdb;
        return $wpdb->prepare(
            $query,
            // phpcs:ignore
            ...$exclude_ids
        );
    }
    private function prepare_search_sql(): string
    {
        if ($this->search === '') {
            return '';
        }
        global $wpdb;
        return $wpdb->prepare('AND (p.post_title LIKE %s OR p2.post_title LIKE %s)', '%' . $this->search . '%', '%' . $this->search . '%');
    }
}
