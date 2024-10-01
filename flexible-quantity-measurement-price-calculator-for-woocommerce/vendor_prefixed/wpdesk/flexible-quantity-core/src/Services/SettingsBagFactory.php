<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services;

use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Collections\SettingsBag;
use WDFQVendorFree\WPDesk\Persistence\Adapter\WordPress\WordpressPostMetaContainer;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Settings as OldSettings;
class SettingsBagFactory
{
    /**
     * @var WordpressPostMetaContainer
     */
    private $meta_container;
    public function __construct(\WDFQVendorFree\WPDesk\Persistence\Adapter\WordPress\WordpressPostMetaContainer $meta_container)
    {
        $this->meta_container = $meta_container;
    }
    public function create() : \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Collections\SettingsBag
    {
        $raw_settings = $this->meta_container->has(\WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Settings::SETTINGS_META_KEY) === \true ? $this->meta_container->get(\WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Settings::SETTINGS_META_KEY) : [];
        return new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Collections\SettingsBag($raw_settings);
    }
}
