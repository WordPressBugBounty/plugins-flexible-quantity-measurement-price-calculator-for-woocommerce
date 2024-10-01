<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Template\Selection\Options;

use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\PostType\FQTemplateType;
abstract class OptionsProviderBase
{
    /**
     * @var string
     */
    protected $search = '';
    /**
     * @var int
     */
    protected $page = 1;
    protected const ITEMS_PER_PAGE = 10;
    protected abstract function get_template_meta_key() : string;
    /**
     * @param string $search
     */
    public function set_search(string $search) : void
    {
        $this->search = $search;
    }
    /**
     * @param int $page
     */
    public function set_page(int $page) : void
    {
        $this->page = $page;
    }
    protected function get_offset() : int
    {
        return ($this->page - 1) * self::ITEMS_PER_PAGE;
    }
    /**
     * Returns IDs that should be excluded in options.
     *
     * @return int[]
     */
    protected function get_excluded_ids() : array
    {
        global $wpdb;
        $results = $wpdb->get_col($wpdb->prepare("\n\t\t\t\tSELECT pm.meta_value\n\t\t\t\tFROM {$wpdb->postmeta} pm\n\t\t\t\tINNER JOIN {$wpdb->posts} pt ON pm.post_id = pt.ID\n\t\t\t\tWHERE pm.meta_key = %s\n\t\t\t\tAND pt.post_type = %s\n\t\t\t\t", $this->get_template_meta_key(), \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\PostType\FQTemplateType::POST_TYPE));
        return \array_map('intval', $results);
    }
    /**
     * @param array<int, array<string, string>> $options
     * @param int $total_records
     *
     * @return array <string, array <mixed, mixed>>
     */
    protected function prepare_response(array $options, int $total_records) : array
    {
        return ['options' => $options, 'pagination' => ['more' => $this->get_offset() + \count($options) < $total_records]];
    }
}
