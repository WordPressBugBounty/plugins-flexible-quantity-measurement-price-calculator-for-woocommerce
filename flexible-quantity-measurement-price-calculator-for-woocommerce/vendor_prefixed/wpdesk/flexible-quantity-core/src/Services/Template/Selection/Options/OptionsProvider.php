<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Template\Selection\Options;

interface OptionsProvider
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public function get_options(): array;
    /**
     * @return array<int, array<string, string>>
     */
    public function get_selected_options(int $template_id, int $pre_selected_product_id = 0): array;
    /**
     * @param string $search
     */
    public function set_search(string $search): void;
    /**
     * @param int $page
     */
    public function set_page(int $page): void;
}
