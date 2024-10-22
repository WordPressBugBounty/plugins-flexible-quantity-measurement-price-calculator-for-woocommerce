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
    public function __construct(TemplateFinder $finder)
    {
        $this->finder = $finder;
        $this->collection = new ArrayCollection();
    }
    public function get(\WC_Product $product): OldSettings
    {
        if ($this->collection->containsKey($product->get_id())) {
            return $this->collection->get($product->get_id());
        }
        $template_id = $this->finder->get($product);
        if ($template_id) {
            $settings_bag = (new SettingsBagFactory(new WordpressPostMetaContainer($template_id)))->create();
            $this->collection->set($product->get_id(), new Settings($settings_bag));
        } else {
            $this->collection->set($product->get_id(), new OldSettings($product->get_id()));
        }
        return $this->collection->get($product->get_id());
    }
}
