<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Template\Selection\Options;

class NullOptionsProvider extends OptionsProviderBase implements OptionsProvider
{
    public function get_template_meta_key(): string
    {
        return '';
    }
    public function get_options(): array
    {
        return [];
    }
    public function get_selected_options(int $template_id, int $pre_selected_product_id = 0): array
    {
        return [];
    }
}
