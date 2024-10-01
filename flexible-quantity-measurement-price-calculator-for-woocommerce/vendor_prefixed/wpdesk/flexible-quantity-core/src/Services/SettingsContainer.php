<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services;

use WDFQVendorFree\Doctrine\Common\Collections\ArrayCollection;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\TemplateFinder;
use WDFQVendorFree\WPDesk\Persistence\Adapter\WordPress\WordpressPostMetaContainer;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Settings as OldSettings;
class SettingsContainer
{
    /**
     * @var TemplateFinder
     */
    private $finder;
    /**
     * Collection of settings.
     *
     * @var ArrayCollection
     */
    private $collection;
    public function __construct(\WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\TemplateFinder $finder)
    {
        $this->finder = $finder;
        $this->collection = new \WDFQVendorFree\Doctrine\Common\Collections\ArrayCollection();
    }
    public function get(\WC_Product $product) : \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Settings
    {
        if ($this->collection->containsKey($product->get_id())) {
            return $this->collection->get($product->get_id());
        }
        $template_id = $this->finder->get($product);
        if ($template_id) {
            $settings_bag = (new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\SettingsBagFactory(new \WDFQVendorFree\WPDesk\Persistence\Adapter\WordPress\WordpressPostMetaContainer($template_id)))->create();
            $this->collection->set($product->get_id(), new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Settings($settings_bag));
        } else {
            $this->collection->set($product->get_id(), new \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Settings($product->get_id()));
        }
        return $this->collection->get($product->get_id());
    }
}
