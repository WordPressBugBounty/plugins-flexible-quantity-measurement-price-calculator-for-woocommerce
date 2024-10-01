<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Template\Selection\Options;

abstract class TermOptionsProvider extends \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Template\Selection\Options\OptionsProviderBase
{
    protected function get_options_by_taxonomy(string $taxonomy) : array
    {
        $args = $this->preapre_args($taxonomy);
        $tags_query = new \WP_Term_Query($args);
        $tags = $tags_query->get_terms();
        $options = \array_map(function ($id, $title) {
            return ['id' => $id, 'text' => $title];
        }, \array_keys($tags), \array_values($tags));
        $response = $this->prepare_response($options, $this->get_total_records($taxonomy));
        return $response;
    }
    /**
     * @return array<string, mixed>
     */
    private function preapre_args(string $taxonomy) : array
    {
        $args = ['taxonomy' => $taxonomy, 'fields' => 'id=>name', 'orderby' => 'title', 'hide_empty' => \false, 'number' => self::ITEMS_PER_PAGE, 'offset' => $this->get_offset()];
        $excluded_ids = $this->get_excluded_ids();
        if (\count($excluded_ids) > 0) {
            $args['exclude'] = $excluded_ids;
        }
        if ($this->search !== '') {
            $args['search'] = $this->search;
        }
        return $args;
    }
    private function get_total_records(string $taxonomy) : int
    {
        $args = $this->preapre_args($taxonomy);
        $args['number'] = -1;
        $args['offset'] = 0;
        $total_recods = \wp_count_terms($args);
        return \is_numeric($total_recods) ? (int) $total_recods : 0;
    }
    /**
     * @param int[] $selection
     *
     * return array<int, array<string, string>>
     */
    protected function get_selected_terms_by_taxonomy(string $taxonomy, array $selection) : array
    {
        return \array_reduce($selection, function ($carry, $id) use($taxonomy) {
            $term = \get_term($id, $taxonomy);
            if ($term) {
                $carry[] = ['text' => $term->name, 'id' => $id];
            }
            return $carry;
        }, []);
    }
}
