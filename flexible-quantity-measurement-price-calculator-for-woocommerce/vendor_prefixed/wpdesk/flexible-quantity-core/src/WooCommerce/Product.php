<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce;

use WC_Product;
use WC_Product_Variable;
class Product
{
    /**
     * Returns true if a calculator is enabled for the given product
     *
     * @since 3.0
     * @param WC_Product $product the product
     * @return bool true if the measurements calculator is enabled and
     *         should be displayed for the product, false otherwise
     */
    public static function calculator_enabled($product, $settings = null)
    {
        // basic checks
        if (!$product instanceof WC_Product || $product->is_type('grouped')) {
            return \false;
        }
        // see whether a calculator is configured for this product
        $settings === null && $settings = new Settings($product);
        // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments
        return $settings->is_calculator_enabled();
    }
    /**
     * Returns true if the price calculator is enabled for the given product
     *
     * @since 3.0
     * @param WC_Product $product the product
     * @return bool true if the price calculator is enabled
     */
    public static function pricing_calculator_enabled($product, $settings = null)
    {
        if ($product instanceof WC_Product && self::calculator_enabled($product, $settings)) {
            // see whether a calculator is configured for this product
            $settings === null && $settings = new Settings($product);
            // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments
            return $settings->is_pricing_calculator_enabled();
        }
        return \false;
    }
    /**
     * Returns true if the price for the given product should be displayed "per
     * unit" regardless of the calculator type (quantity or pricing)
     *
     * @since 3.0
     * @param WC_Product $product the product
     * @return bool true if the price should be displayed "per unit"
     */
    public static function pricing_per_unit_enabled($product)
    {
        if ($product instanceof WC_Product && self::calculator_enabled($product)) {
            // see whether a calculator is configured for this product
            $settings = new Settings($product);
            return $settings->is_pricing_enabled();
        }
        return \false;
    }
    /**
     * Returns true if the price calculator and stock management are enabled for the given product
     *
     * @since 3.0
     * @param WC_Product $product the product
     * @return bool true if the price calculator and stock management are enabled
     */
    public static function pricing_calculator_inventory_enabled($product)
    {
        // TODO: also verify that stock is being managed for the product?
        // Use case: stock management turned on, pricing calculator inventory enabled, stock management is disabled
        if ($product instanceof WC_Product && self::calculator_enabled($product)) {
            // see whether a calculator is configured for this product
            $settings = new Settings($product);
            return $settings->is_pricing_inventory_enabled();
        }
        return \false;
    }
    public static function shipping_calculator_inventory_enabled($product)
    {
        // TODO: also verify that stock is being managed for the product?
        // Use case: stock management turned on, pricing calculator inventory enabled, stock management is disabled
        if ($product instanceof WC_Product && self::calculator_enabled($product)) {
            // see whether a calculator is configured for this product
            $settings = new Settings($product);
            return $settings->is_pricing_inventory_enabled();
        }
        return \false;
    }
    /**
     * Returns true if the price calculator and calculated weight are enabled for the given product
     *
     * @since 3.0
     * @param WC_Product $product the product
     * @return bool true if the price calculator and stock management are enabled
     */
    public static function pricing_calculated_weight_enabled($product)
    {
        if ($product instanceof WC_Product && self::calculator_enabled($product)) {
            if ('no' !== get_option('woocommerce_enable_weight', \true)) {
                // see whether a calculator is configured for this product
                $settings = new Settings($product);
                return $settings->is_pricing_calculated_weight_enabled();
            }
        }
        return \false;
    }
    public static function get_product_measurement($product, $settings)
    {
        switch ($settings->get_calculator_type()) {
            case 'dimension':
                return self::get_dimension_measurement($product, $settings->get_calculator_measurements());
            case 'area':
            case 'area-dimension':
                return self::get_area_measurement($product);
            case 'area-linear':
                return self::get_perimeter_measurement($product);
            case 'area-surface':
                return self::get_surface_area_measurement($product);
            case 'volume':
            case 'volume-dimension':
            case 'volume-area':
                return self::get_volume_measurement($product);
            case 'weight':
                return self::get_weight_measurement($product);
            case 'custom':
            case 'other':
                return self::get_other_measurement($product);
            // just a specially presented area calculator
            case 'wall-dimension':
                return self::get_area_measurement($product);
            default:
                return null;
        }
    }
    /**
     * Gets a dimension (length, width or height) of the product, based on
     * $measurements, and in woocommerce dimension units
     *
     * @param WC_Product $product        the product
     * @param Measurement[] $measurements width, length or height
     *
     * @return Measurement measurement object in product units
     * @since 3.0
     */
    public static function get_dimension_measurement($product, $measurements)
    {
        // get the one (and only) measurement object
        list($measurement) = $measurements;
        $unit = get_option('woocommerce_dimension_unit');
        $measurement_name = $measurement->get_name();
        /**
         * Filter dimension measurement value.
         *
         * @param float $measurement_value The dimension measurement value
         * @param WC_Product $product
         * @param Measurement $measurement the measurement class instance
         *
         *@since 3.5.2
         */
        $measurement_value = apply_filters('fq_price_calculator_measurement_dimension', is_callable([$product, "get_{$measurement_name}"]) ? $product->{"get_{$measurement_name}"}() : null, $product, $measurement);
        return new Measurement($unit, $measurement_value, $measurement_name, ucwords($measurement_name));
    }
    /**
     * Gets the area of the product, if one is defined, in woocommerce product units
     *
     * @param WC_Product $product the product
     *
     * @return Measurement total area measurement for the product
     * @since 3.0
     */
    public static function get_area_measurement($product)
    {
        $measurement = null;
        $length = $product->get_length();
        $width = $product->get_width();
        // if a length and width are defined, use that
        if (is_numeric($length) && is_numeric($width)) {
            $area = $length * $width;
            /**
             * Filter area measurement value.
             *
             * @since 3.5.2
             * @param float $area The area measurement value
             * @param WC_Product $product
             */
            $area = apply_filters('fq_price_calculator_measurement_area', $area, $product);
            $unit = Measurement::to_area_unit(get_option('woocommerce_dimension_unit'));
            $measurement = new Measurement($unit, $area, 'area', __('Area', 'flexible-quantity-measurement-price-calculator-for-woocommerce'));
            // convert to the product area units
            $measurement->set_unit(get_option('woocommerce_area_unit'));
        }
        // if they overrode the length/width with an area value, use that
        $area = $product->get_meta('_area');
        // fallback to parent meta for variations if not set
        if (!$area && $product->is_type('variation')) {
            $parent_product = wc_get_product($product->get_parent_id());
            if ($parent_product) {
                $area = $parent_product->get_meta('_area');
            }
        }
        if (!empty($area)) {
            $measurement = new Measurement(get_option('woocommerce_area_unit'), $area, 'area', __('Area', 'flexible-quantity-measurement-price-calculator-for-woocommerce'));
        }
        // if no measurement, just create a default empty one
        if (!$measurement) {
            $measurement = new Measurement(get_option('woocommerce_area_unit'), 0, 'area', __('Area', 'flexible-quantity-measurement-price-calculator-for-woocommerce'));
        }
        return $measurement;
    }
    /**
     * Gets the linear area of the product, if one is defined, in woocommerce product units
     *
     * @param WC_Product $product the product
     *
     * @return Measurement total perimeter measurement for the product
     * @since 3.2
     */
    public static function get_perimeter_measurement($product)
    {
        $measurement = null;
        $length = $product->get_length();
        $width = $product->get_width();
        // if a length and width are defined, use that
        if (is_numeric($length) && is_numeric($width)) {
            $perimeter = 2 * $length + 2 * $width;
            /**
             * Filter perimeter measurement value.
             *
             * @since 3.5.2
             * @param float $perimeter The perimeter measurement value
             * @param WC_Product $product
             */
            $perimeter = apply_filters('fq_price_calculator_measurement_perimeter', $perimeter, $product);
            $measurement = new Measurement(get_option('woocommerce_dimension_unit'), $perimeter, 'length', __('Perimeter', 'flexible-quantity-measurement-price-calculator-for-woocommerce'));
        }
        // if no measurement, just create a default empty one
        if (!$measurement) {
            $measurement = new Measurement(get_option('woocommerce_dimension_unit'), 0, 'length', __('Perimeter', 'flexible-quantity-measurement-price-calculator-for-woocommerce'));
        }
        return $measurement;
    }
    /**
     * Gets the surface area of the product, if one is defined, in woocommerce product units
     *
     * @param WC_Product $product the product
     *
     * @return Measurement total perimeter measurement for the product
     * @since 3.5.0
     */
    public static function get_surface_area_measurement($product)
    {
        $measurement = null;
        $length = $product->get_length();
        $width = $product->get_width();
        $height = $product->get_height();
        // if a length and width are defined, use that
        if (is_numeric($length) && is_numeric($width) && is_numeric($height)) {
            $surface_area = 2 * ($length * $width + $width * $height + $length * $height);
            /**
             * Filter surface area value.
             *
             * @since 3.5.0
             * @param float $surface_area The calculated surface area.
             * @param WC_Product $product
             */
            $surface_area = apply_filters('fq_price_calculator_measurement_surface_area', $surface_area, $product);
            $measurement = new Measurement(get_option('woocommerce_dimension_unit'), $surface_area, 'area', __('Surface Area', 'flexible-quantity-measurement-price-calculator-for-woocommerce'));
        }
        // if no measurement, just create a default empty one
        if (!$measurement) {
            $measurement = new Measurement(get_option('woocommerce_dimension_unit'), 0, 'area', __('Surface Area', 'flexible-quantity-measurement-price-calculator-for-woocommerce'));
        }
        return $measurement;
    }
    /**
     * Gets the volume of the product, if one is defined, in woocommerce product units
     *
     * @param WC_Product $product the product
     *
     * @return Measurement total volume measurement for the product, or null
     * @since 3.0
     */
    public static function get_volume_measurement($product)
    {
        $measurement = null;
        $length = $product->get_length();
        $width = $product->get_width();
        $height = $product->get_height();
        // if a length and width are defined, use that.  We allow large and small dimensions
        // (mm, km, mi) which don't make much sense to use as volumes, but
        // we have no choice but to support them to some extent, so convert
        // them to something more reasonable
        if (is_numeric($length) && is_numeric($width) && is_numeric($height)) {
            $volume = $length * $width * $height;
            switch (get_option('woocommerce_dimension_unit')) {
                case 'mm':
                    $volume *= 0.001;
                    // convert to ml
                    break;
                case 'km':
                    $volume *= 1000000000;
                    // convert to cu m
                    break;
                case 'mi':
                    $volume *= 5451776000;
                    // convert to cu yd
                    break;
            }
            /**
             * Filter volume measurement value.
             *
             * @since 3.5.2
             * @param float $volume The volume measurement value
             * @param WC_Product $product
             */
            $volume = apply_filters('fq_price_calculator_measurement_volume', $volume, $product);
            $unit = Measurement::to_volume_unit(get_option('woocommerce_dimension_unit'));
            $measurement = new Measurement($unit, $volume, 'volume', __('Volume', 'flexible-quantity-measurement-price-calculator-for-woocommerce'));
            // convert to the product volume units
            $measurement->set_unit(get_option('woocommerce_volume_unit'));
        }
        // if there's an area and height, next use that
        $area = $product->get_meta('_area');
        // fallback to parent meta for variations if not set
        if (!$area && $product->is_type('variation')) {
            $parent_product = wc_get_product($product->get_parent_id());
            if ($parent_product) {
                $area = $parent_product->get_meta('_area');
            }
        }
        if (!empty($area) && is_numeric($height)) {
            $area_unit = get_option('woocommerce_area_unit');
            $area_measurement = new Measurement($area_unit, $area);
            $dimension_unit = get_option('woocommerce_dimension_unit');
            $dimension_measurement = new Measurement($dimension_unit, $product->get_height());
            // determine the volume, in common units
            $dimension_measurement->set_common_unit($area_measurement->get_unit_common());
            $volume = $area_measurement->get_value_common() * $dimension_measurement->get_value_common();
            /**
             * Filter volume measurement value.
             *
             * @since 3.5.2
             * @param float $volume The volume measurement value
             * @param WC_Product $product
             */
            $volume = apply_filters('fq_price_calculator_measurement_volume', $volume, $product);
            $volume_unit = Measurement::to_volume_unit($area_measurement->get_unit_common());
            $measurement = new Measurement($volume_unit, $volume, 'volume', __('Volume', 'flexible-quantity-measurement-price-calculator-for-woocommerce'));
            // and convert to final volume units
            $measurement->set_unit(get_option('woocommerce_volume_unit'));
        }
        // finally if they overrode the length/width/height with a volume value, use that
        $volume = $product->get_meta('_volume');
        // fallback to parent meta for variations if not set
        if (!$volume && $product->is_type('variation')) {
            $parent_product = wc_get_product($product->get_parent_id());
            if ($parent_product) {
                $volume = $parent_product->get_meta('_volume');
            }
        }
        if (!empty($volume)) {
            $measurement = new Measurement(get_option('woocommerce_volume_unit'), $volume, 'volume', __('Volume', 'flexible-quantity-measurement-price-calculator-for-woocommerce'));
        }
        // if no measurement, just create a default empty one
        if (!$measurement) {
            $measurement = new Measurement(get_option('woocommerce_volume_unit'), 0, 'volume', __('Volume', 'flexible-quantity-measurement-price-calculator-for-woocommerce'));
        }
        return $measurement;
    }
    /**
     * Gets the weight of the product, if one is defined, in woocommerce product units
     *
     * @param WC_Product $product the product
     *
     * @return Measurement weight measurement for the product
     * @since 3.0
     */
    public static function get_weight_measurement($product)
    {
        return new Measurement(get_option('woocommerce_weight_unit'), $product->get_weight(), 'weight', __('Weight', 'flexible-quantity-measurement-price-calculator-for-woocommerce'));
    }
    public static function get_other_measurement($product)
    {
        return new Measurement('item', 1, 'other', \__('Other', 'flexible-quantity-measurement-price-calculator-for-woocommerce'));
    }
    /**
     * Get the min/max quantity range for this given product.  At least, do
     * the best we can.  The issue is that this is controlled ultimately by
     * template files, which could be changed by the user/theme.
     *
     * @see woocommerce-template.php woocommerce_quantity_input()
     * @see woocommerce/templates/single-product/add-to-cart/simple.php
     * @see woocommerce/templates/single-product/add-to-cart/variable.php
     *
     * @since 3.0
     * @param WC_Product $product the product
     * @return array associative array with keys 'min_value' and 'max_value'
     */
    public static function get_quantity_range($product)
    {
        // get the quantity min/max for this product
        $defaults = ['input_name' => 'quantity', 'input_value' => '1', 'max_value' => '', 'min_value' => '0'];
        $args = [];
        if ($product->is_type('simple')) {
            $args = ['min_value' => 1, 'max_value' => $product->backorders_allowed() ? '' : $product->get_stock_quantity()];
        }
        /**
         * Filters the quantity input args
         *
         * @see woocommerce/includes/wc-template-functions.php
         *
         * @param array $args the input arguments
         * @param WC_Product $product the product instance
         */
        return apply_filters('woocommerce_quantity_input_args', wp_parse_args($args, $defaults), $product);
    }
    /**
     * Calculate the item price based on the given measurements
     *
     * @since 3.1.3
     * @param WC_Product $product the product
     * @param float $measurement_needed_value the total measurement needed
     * @param string $measurement_needed_value_unit the unit of $measurement_needed_value
     * @param bool $round Optional. If true the returned price will be rounded to two decimal places. Default false.
     * @return float the calculated price
     */
    public static function calculate_price($product, $measurement_needed_value, $measurement_needed_value_unit, $round = \false, $settings = null)
    {
        // get the parent product if there is one
        if ($product->is_type('variation')) {
            $parent = wc_get_product($product->get_parent_id());
        } else {
            $parent = $product;
        }
        $price = $product->get_price();
        if (self::pricing_calculator_enabled($parent, $settings)) {
            $measurement_needed = new Measurement($measurement_needed_value_unit, (float) $measurement_needed_value);
            // if this calculator uses pricing rules, retrieve the price based on the product measurements
            $rule_price = $settings->get_pricing_rules_price($measurement_needed);
            if ($rule_price) {
                $product->set_price($rule_price);
                $price = $rule_price;
            }
            // calculate the price
            $price = $price * $measurement_needed->get_value($settings->get_pricing_unit());
            // is there a minimum price to use?
            $min_price = $product->get_meta('_fq_price_calculator_min_price');
            if (is_numeric($min_price) && $min_price > $price) {
                $price = $min_price;
            }
        }
        /**
         * Filters if the calculated price should be rounded
         *
         * @since 3.10.1
         * @param bool $round if true, the returned price will be rounded to two decimal places.
         * @param WC_Product $product the product.
         */
        if (\true === apply_filters('fq_price_calculator_round_calculated_price', $round, $product)) {
            $price = round($price, wc_get_price_decimals());
        }
        /**
         * Filters the final calculated price.
         *
         * @since 3.14.0
         *
         * @param float $price the calculated price
         * @param WC_Product $product the product
         * @param float $measurement_needed_value the total measurement needed
         * @param string $measurement_needed_value_unit the unit of $measurement_needed_value
         */
        return apply_filters('fq_price_calculator_calculate_price', $price, $product, $measurement_needed_value, $measurement_needed_value_unit);
    }
    /**
     * Returns the price html for the pricing rules table associated with $product.
     *
     * Ie:
     * * "$5,00 - $6,00 / sq ft"
     * * "$5,00 / ft"
     * * "$0,00"
     * * etc
     *
     * @since 3.0
     *
     * @param WC_Product $product the product
     *
     * @return string pricing rules price HTML string
     */
    public static function get_pricing_rules_price_html($product, $settings)
    {
        $price_html = '';
        $price = $min_price = $settings->get_pricing_rules_minimum_price();
        // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments
        $min_regular_price = $settings->get_pricing_rules_minimum_regular_price();
        $max_price = $settings->get_pricing_rules_maximum_price();
        $max_regular_price = $settings->get_pricing_rules_maximum_regular_price();
        $sep = apply_filters('fq_price_calculator_pricing_label_separator', '/');
        $pricing_label = $sep . ' ' . $settings->get_pricing_label();
        // Get the price
        if ($price > 0) {
            // Regular price
            if ($settings->pricing_rules_is_on_sale() && $min_regular_price !== $price) {
                if (!$min_price || $min_price !== $max_price) {
                    $from = wc_price($min_regular_price) . ' - ' . wc_price($max_regular_price) . ' ' . $pricing_label;
                    $to = wc_price($min_price) . ' - ' . wc_price($max_price) . ' ' . $pricing_label;
                    $price_html .= self::get_price_html_from_to($from, $to, '') . $product->get_price_suffix();
                } else {
                    $price_html .= self::get_price_html_from_to($min_regular_price, $price, $pricing_label) . $product->get_price_suffix();
                }
            } else {
                $price_html .= wc_price($price);
                if ($min_price !== $max_price) {
                    $price_html .= ' - ' . wc_price($max_price);
                }
                $price_html .= ' ' . $pricing_label . $product->get_price_suffix();
            }
        } elseif (0 == $price) {
            // Free price
            if ($min_regular_price !== $price && $settings->pricing_rules_is_on_sale()) {
                if ($min_price !== $max_price) {
                    $from = wc_price($min_regular_price) . ' - ' . wc_price($max_regular_price) . ' ' . $pricing_label;
                    $to = wc_price(0) . ' - ' . wc_price($max_price) . ' ' . $pricing_label;
                    $price_html .= self::get_price_html_from_to($from, $to, '') . $product->get_price_suffix();
                } else {
                    $price_html .= self::get_price_html_from_to($min_regular_price, wc_price(0), $pricing_label);
                }
            } else {
                $price_html .= wc_price(0);
                if ($min_price !== $max_price) {
                    $price_html .= ' - ' . wc_price($max_price);
                }
                $price_html .= ' ' . $pricing_label;
            }
        }
        // set the product's price property to fix rich snippets
        $product->set_price($max_price);
        /**
         * Filter the HTML price.
         *
         * @see ProductPage::price_per_unit_html() for more usages
         *
         * @since 3.12.3
         *
         * @param string $price_html the HTML price
         * @param WC_Product $product the product with MPC settings
         * @param string $pricing_label e.g. / sq m
         * @param bool $quantity_calculator_enabled whether the quantity calculator is enabled for the product
         * @param bool $pricing_rules_enabled whether pricing rules are enabled for the product
         */
        return (string) apply_filters('fq_price_calculator_get_price_html', $price_html, $product, $pricing_label, \false, \true);
    }
    /**
     * Functions for getting parts of a price, in html, used by get_price_html.
     *
     * @since 3.0
     * @param mixed $from the 'from' price or string
     * @param mixed $to the 'to' price or string
     * @param string $pricing_label the pricing label to display
     * @return string the pricing from-to HTML
     */
    public static function get_price_html_from_to($from, $to, $pricing_label)
    {
        return '<del>' . (is_numeric($from) ? wc_price($from) . ' ' . $pricing_label : $from) . '</del> <ins>' . (is_numeric($to) ? wc_price($to) . ' ' . $pricing_label : $to) . '</ins>';
    }
    /**
     * Returns an array of measurements for the given product
     *
     * @since 3.0
     * @param WC_Product $product the product
     * @return void|array of WC_Price_Calculator_Measurement objects for the product
     */
    public static function get_product_measurements($product)
    {
        if (self::pricing_calculator_enabled($product)) {
            $settings = new Settings($product);
            return $settings->get_calculator_measurements();
        }
    }
    /**
     * Sync variable product prices with the children lowest/highest price per
     * unit.
     * Code based on \WC_Product_Variable version 2.0.0
     *
     * @param WC_Product_Variable $product  the variable product
     * @param Settings             $settings the calculator settings
     *
     * @since 3.0
     * @see \WC_Product_Variable::variable_product_sync()
     * @see Product::variable_product_unsync()
     */
    public static function variable_product_sync($product, $settings)
    {
        // save the original values so we can restore the product
        $product->wcmpc_min_variation_price = $product->get_variation_price('min');
        $product->wcmpc_min_variation_regular_price = $product->get_variation_regular_price('min');
        $product->wcmpc_min_variation_sale_price = $product->get_variation_sale_price('min');
        $product->wcmpc_max_variation_price = $product->get_variation_price('max');
        $product->wcmpc_max_variation_regular_price = $product->get_variation_regular_price('max');
        $product->wcmpc_max_variation_sale_price = $product->get_variation_sale_price('max');
        $product->wcmpc_price = $product->get_price('edit');
        // default product prices
        $product_new_prices = ['min_variation_price' => '', 'min_variation_regular_price' => '', 'min_variation_sale_price' => '', 'max_variation_price' => '', 'max_variation_regular_price' => '', 'max_variation_sale_price' => ''];
        $product->set_props($product_new_prices);
        foreach ($product->get_children() as $variation_product_id) {
            $variation_product = apply_filters('fq_price_calculator_variable_product_sync', wc_get_product($variation_product_id), $product);
            $child_price = $variation_product->get_price('edit');
            $child_regular_price = $variation_product->get_regular_price('edit');
            $child_sale_price = $variation_product->get_sale_price('edit');
            // variation prices
            $min_variation_regular_price = $product->get_variation_regular_price('min');
            $max_variation_regular_price = $product->get_variation_regular_price('max');
            $min_variation_sale_price = $product->get_variation_sale_price('min');
            $max_variation_sale_price = $product->get_variation_sale_price('max');
            $min_variation_price = $product->get_variation_price('min');
            $max_variation_price = $product->get_variation_price('max');
            // get the product measurement
            $measurement = self::get_product_measurement($variation_product, $settings);
            if (!$measurement) {
                continue;
            }
            $measurement->set_unit($settings->get_pricing_unit());
            if ('' === $child_price && '' === $child_regular_price || !$measurement->get_value()) {
                continue;
            }
            $measurement_value = $measurement->get_value();
            // convert to price per unit
            if ('' !== $child_price && $measurement_value > 0) {
                $child_price /= $measurement_value;
            }
            // regular prices
            if ($child_regular_price !== '') {
                // convert to price per unit
                $child_regular_price /= $measurement_value > 0 ? $measurement_value : 1;
                if (!is_numeric($min_variation_regular_price) || $child_regular_price < $min_variation_regular_price) {
                    $product_new_prices['min_variation_regular_price'] = $child_regular_price;
                }
                if (!is_numeric($max_variation_regular_price) || $child_regular_price > $max_variation_regular_price) {
                    $product_new_prices['max_variation_regular_price'] = $child_regular_price;
                }
            }
            // sale prices
            if ($child_sale_price !== '') {
                // convert to price per unit
                $child_sale_price /= $measurement_value > 0 ? $measurement_value : 1;
                if ($child_price == $child_sale_price) {
                    if (!is_numeric($min_variation_sale_price) || $child_sale_price < $min_variation_sale_price) {
                        $product_new_prices['min_variation_sale_price'] = $child_sale_price;
                    }
                    if (!is_numeric($max_variation_sale_price) || $child_sale_price > $max_variation_sale_price) {
                        $product_new_prices['max_variation_sale_price'] = $child_sale_price;
                    }
                }
            }
            // actual prices
            if ($child_price !== '') {
                if ($child_price > $max_variation_price) {
                    $product_new_prices['max_variation_price'] = $child_price;
                }
                if ('' === $min_variation_price || $child_price < $min_variation_price) {
                    $product_new_prices['min_variation_price'] = $child_price;
                }
            }
        }
        // as seen in WC_Product_Variable::get_price_html()
        $product_new_prices['price'] = $product_new_prices['min_variation_price'];
        $product->set_props($product_new_prices);
    }
    /**
     * Restores the given variable $product min/max pricing back to the original
     * values found before variable_product_sync() was invoked
     *
     * @param WC_Product_Variable $product the variable product
     *
     * @since 3.0
     * @see Product::variable_product_sync()
     */
    public static function variable_product_unsync($product)
    {
        // restore the variable product back to normal
        $product->min_variation_price = $product->wcmpc_min_variation_price;
        $product->min_variation_regular_price = $product->wcmpc_min_variation_regular_price;
        $product->min_variation_sale_price = $product->wcmpc_min_variation_sale_price;
        $product->max_variation_price = $product->wcmpc_max_variation_price;
        $product->max_variation_regular_price = $product->wcmpc_max_variation_regular_price;
        $product->max_variation_sale_price = $product->wcmpc_max_variation_sale_price;
        $product->price = $product->wcmpc_price;
    }
}
