<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services;

use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Collections\SettingsBag;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Settings as OldSettings;
class Settings extends OldSettings
{
    /**
     * @var SettingsBag
     */
    private $settings_bag;
    public function __construct(SettingsBag $settings_bag)
    {
        $this->settings_bag = $settings_bag;
    }
    /**
     * Returns the settings as an array (backwards compatibility)
     *
     * @return array
     */
    public function get_settings()
    {
        return $this->settings_bag->toArray();
    }
    /**
     * There is no enable flag in current settings.
     *
     * @return bool
     */
    public function is_calculator_enabled()
    {
        return \true;
    }
    public function get_price()
    {
        return $this->get_sale_price() !== '' ? $this->get_sale_price() : $this->get_regular_price();
    }
    public function get_regular_price()
    {
        $price = $this->settings_bag->bag('fq')->getString('price');
        if ($price !== '') {
            return abs($price);
        }
        return '';
    }
    public function get_sale_price()
    {
        $price = $this->settings_bag->bag('fq')->getString('sale_price');
        if ($price !== '') {
            return abs($price);
        }
        return '';
    }
    public function get_sold_individually()
    {
        return $this->settings_bag->bag('fq')->getString('sold_individually') === 'yes';
    }
    /**
     * Returns the product associated with this settins object, if any
     *
     * @return WC_Product the product object
     */
    public function get_product()
    {
        return $this->product;
    }
    /**
     * Sets the given pricing rules, verifying for correctness: a rule must have
     * a numeric (non-negative) start and price to be valid.  The pricing rules
     * will be in terms of the pricing unit.
     *
     * @since 3.0
     * @param array $pricing_rules the pricing rules
     */
    protected function set_pricing_rules($pricing_rules)
    {
        $this->pricing_rules = [];
        if (is_array($pricing_rules)) {
            foreach ($pricing_rules as $rule) {
                if (isset($rule['range_start'], $rule['regular_price']) && is_numeric($rule['range_start']) && $rule['range_start'] >= 0 && is_numeric($rule['regular_price']) && $rule['regular_price'] >= 0) {
                    $this->pricing_rules[] = $rule;
                }
            }
        }
    }
}
