<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Template\Selection\Options;

class TagOptionsProvider extends \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Template\Selection\Options\TermOptionsProvider implements \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Template\Selection\Options\OptionsProvider
{
    private const TAXONOMY = 'product_tag';
    public function get_template_meta_key() : string
    {
        return 'tag_id';
    }
    public function get_options() : array
    {
        return $this->get_options_by_taxonomy(self::TAXONOMY);
    }
    public function get_selected_options(int $template_id, int $pre_selected_product_id = 0) : array
    {
        $selection = \get_post_meta($template_id, $this->get_template_meta_key(), \false);
        if (empty($selection)) {
            // @phpstan-ignore-line
            return [];
        }
        return $this->get_selected_terms_by_taxonomy(self::TAXONOMY, $selection);
    }
}
