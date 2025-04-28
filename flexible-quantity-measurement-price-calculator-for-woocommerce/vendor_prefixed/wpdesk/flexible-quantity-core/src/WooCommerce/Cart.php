<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce;

use WC_Cart;
use WC_Order;
use Exception;
use WC_Product;
use WC_Product_Variation;
use WC_Order_item_Product;
use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\SettingsContainer;
class Cart implements Hookable
{
    /** @var array associative array of measurements needed Array( 'value' => (float) $value, 'unit' => $unit, 'common_unit' => $common_unit ) */
    private $measurements_needed = [];
    public const DEFAULT_MEASUREMENT_NEEDED_ROUNDING_PRECISION = 4;
    private SettingsContainer $settings_container;
    public function __construct(SettingsContainer $settings_container)
    {
        $this->settings_container = $settings_container;
    }
    /**
     * Construct and initialize the class.
     *
     * @since 3.0
     */
    public function hooks()
    {
        // cart filters/actions to display the user-supplied product measurements and set the correct price for the pricing calculator
        add_filter('woocommerce_add_cart_item_data', [$this, 'get_cart_item_data'], 10, 3);
        // validation for pricing calculator which requires a measurement to be provided
        add_filter('woocommerce_add_to_cart_validation', [$this, 'add_to_cart_validation'], 10, 6);
        // persist the cart item data, and set the item price (when needed) first, before any other plugins
        add_filter('woocommerce_get_cart_item_from_session', [$this, 'get_cart_item_from_session'], 1, 2);
        // add compatibility with WooCommerce Dynamic Pricing
        add_action('wc_dynamic_pricing_adjusted_price', [$this, 'dynamic_pricing_adjusted_price'], 10, 3);
        // handle customer input as order item meta
        add_filter('woocommerce_get_item_data', [$this, 'display_product_data_in_cart'], 10, 2);
        add_action('woocommerce_checkout_create_order_line_item', [$this, 'set_order_item_meta'], 10, 3);
        // set the actual unit quantity (ie *2* fabrics at 3 ft each, rather than '6')
        add_filter('woocommerce_order_item_quantity', [$this, 'use_calculated_inventory_quantity'], 10, 3);
        add_filter('woocommerce_add_cart_item', [$this, 'set_product_shipping_methods'], 1, 1);
        // set the correct cart contents count
        add_filter('woocommerce_cart_contents_count', [$this, 'set_cart_contents_count']);
        // "order again" handling
        add_filter('woocommerce_order_again_cart_item_data', [$this, 'order_again_cart_item_data'], 10, 3);
        // when item added successfully
        add_action('woocommerce_add_to_cart', [$this, 'clear_inputs_cookie'], 999, 2);
        // cart_id hash can not be based on wc quantity
        \add_filter('woocommerce_cart_id', [$this, 'get_cart_id'], 10, 5);
    }
    /**
     * Filter to check whether a product is valid to be added to the cart.
     * This is used to ensure a measurement is provided when the price
     * calculator is used
     *
     * @since 3.0
     * @param bool $valid whether the product as added is valid
     * @param int $product_id the product identifier
     * @param int $quantity the amount being added
     * @param int|string $variation_id optional variation id
     * @param array $variations optional variation configuration
     * @param array $cart_item_data optional cart item data.  This will only be
     *        supplied when an order is being-ordered, in which case the
     *        required measurements will not be available from the REQUEST array
     * @return bool
     */
    public function add_to_cart_validation($valid, $product_id, $quantity, $variation_id = '', $variations = [], $cart_item_data = [])
    {
        $product = $variation_id ? wc_get_product($variation_id) : wc_get_product($product_id);
        $settings = $this->settings_container->get($product);
        // is the calculator enabled for this product?
        if ($valid && Product::pricing_calculator_enabled($product, $settings)) {
            $measurements = $settings->get_calculator_measurements();
            $product_settings = $settings->get_settings();
            // the individual measurements (for simple calculators like the length or weight or area this will be just the length/weight/area/whatever,
            // while for more complicated ones like area-dimension this will be the length and width
            foreach ($measurements as $measurement) {
                $value = null;
                $message = '';
                if (isset($_REQUEST[$measurement->get_name() . '_needed'])) {
                    $sanitized_value = sanitize_text_field(wp_unslash($_REQUEST[$measurement->get_name() . '_needed']));
                    $value = str_replace(get_option('woocommerce_price_decimal_sep'), '.', $sanitized_value);
                } elseif (isset($cart_item_data['pricing_item_meta_data'][$measurement->get_name()])) {
                    $value = $cart_item_data['pricing_item_meta_data'][$measurement->get_name()];
                }
                $value = abs((float) Measurement::convert_to_float($value));
                // entered measurement value is undefined or invalid
                if (!is_numeric($value) || $value <= 0) {
                    /* translators: Placeholders: %s - measurement label */
                    $message = sprintf(__('%s missing.', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), $measurement->get_label());
                    // there is a value, we need to check if range or step restrictions exist
                } else {
                    $input_attributes = $settings->get_input_attributes($measurement->get_name());
                    // note: the following customer input validation sits on top of browser input min/max validation for number input fields
                    $input_minimum = isset($input_attributes['min']) && is_numeric($input_attributes['min']) ? (float) abs($input_attributes['min']) : null;
                    $input_maximum = isset($input_attributes['max']) && is_numeric($input_attributes['max']) ? (float) abs($input_attributes['max']) : null;
                    $input_increment = isset($input_attributes['step']) && is_numeric($input_attributes['step']) ? (float) abs($input_attributes['step']) : null;
                    // there is a minimum input value defined and the value is below that amount
                    if ($input_minimum && $value < $input_minimum) {
                        /* translators: Placeholders: %1$s - measurement label, %2$s - measurement value (number) */
                        $message = sprintf(__('%1$s value must be greater than or equal to %2$s.', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), $measurement->get_label(), $input_minimum);
                        // there is a maximum input value defined and the value is above that amount
                    } elseif ($input_maximum && $value > $input_maximum) {
                        /* translators: Placeholders: %1$s - measurement label, %2$s - measurement value (number) */
                        $message = sprintf(__('%1$s value must be less than or equal to %2$s.', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), $measurement->get_label(), $input_maximum);
                    }
                    // the value entered is not a multiple of the specified increment
                    if ($value > 0 && $input_increment > 0 && !(abs($value / $input_increment - round($value / $input_increment)) < 0.0001)) {
                        // maybe append to previous message string
                        if ('' !== $message) {
                            $message .= "\n";
                        }
                        /* translators: Placeholders: %1$s - measurement label, %2$s - input measure increment value (step amount) */
                        $message .= sprintf(__('%1$s value must be in increments of %2$s.', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), $measurement->get_label(), $input_increment);
                    }
                }
                if ('' !== $message) {
                    wc_add_notice($message, 'error');
                    $valid = \false;
                    continue;
                }
                // we're good so far: save the value of measurement needed
                if ($value) {
                    $this->measurements_needed[$measurement->get_name()] = ['value' => $value, 'unit' => $measurement->get_unit(), 'common_unit' => $measurement->get_unit_common()];
                }
            }
            $cart_item_data = $this->get_cart_item_data($cart_item_data, $product_id, $variation_id);
            if (isset($cart_item_data['pricing_item_meta_data']) && isset($cart_item_data['pricing_item_meta_data']['_measurement_needed'])) {
                $measurements_needed_main = abs($cart_item_data['pricing_item_meta_data']['_measurement_needed']);
                $measurements_needed_unit_str = $cart_item_data['pricing_item_meta_data']['_measurement_needed_unit'];
                if (trim($product_settings['fq']['min_range']) !== '') {
                    if ((int) $product_settings['fq']['min_range'] > $measurements_needed_main) {
                        $message .= sprintf(__('Product mesurment value (%1$s) must be greater than or equal to %2$s.', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), $measurements_needed_main . ' ' . $measurements_needed_unit_str, $product_settings['fq']['min_range'] . ' ' . $measurements_needed_unit_str);
                        $message .= '<br>';
                    }
                }
                if (trim($product_settings['fq']['max_range']) !== '') {
                    if ($measurements_needed_main > (float) $product_settings['fq']['max_range']) {
                        $message .= sprintf(__('Product mesurment value (%1$s) must be less than or equal to %2$s.', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), $measurements_needed_main . ' ' . $measurements_needed_unit_str, $product_settings['fq']['max_range'] . ' ' . $measurements_needed_unit_str);
                        $message .= '<br>';
                    }
                }
                if (trim($product_settings['fq']['increment']) !== '' && !$this->is_mesurement_value_valid_by_increment((float) $measurements_needed_main, (float) $product_settings['fq']['increment'])) {
                    $message .= sprintf(__('The size of the product is %1$s, allowed increment value is %2$s, please change the size of the product.', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), $measurements_needed_main . ' ' . $measurements_needed_unit_str, $product_settings['fq']['increment'] . ' ' . $measurements_needed_unit_str);
                    $message .= '<br>';
                }
                if ('' !== $message) {
                    wc_add_notice($message, 'error');
                    $valid = \false;
                }
            }
            // allow other code to validate based on the provided measurements
            $valid = (bool) apply_filters('fq_price_calculator_add_to_cart_validation', $valid, $product_id, $quantity, $measurements);
        }
        return $valid;
    }
    /**
     * Add any user-supplied product pricing measurement field data to the
     * cart item data, to set in the session
     *
     * @since 3.0
     * @param array $cart_item_data associative-array of name/value pairs of cart item data
     * @param int $product_id the product identifier
     * @param int $variation_id optional product variation identifier
     * @return array associative array of name/value pairs of cart item
     *         data to set in the session
     */
    public function get_cart_item_data($cart_item_data, $product_id, $variation_id): array
    {
        $product = $variation_id ? wc_get_product($variation_id) : wc_get_product($product_id);
        $settings = $this->settings_container->get($product);
        // is this a product with a pricing calculator?
        if (Product::pricing_calculator_enabled($product, $settings)) {
            // now we want the variation if there is one
            $_product = $variation_id ? wc_get_product($variation_id) : $product;
            // get the measurement needed, from the $_POST object for a normal add to cart action, or from the $cart_item_data for a programmatic add-to-cart
            $measurement_needed_value = $measurement_needed_value_unit = null;
            // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.Found
            if (isset($_POST['_measurement_needed'], $_POST['_measurement_needed_unit']) && !empty($this->measurements_needed)) {
                // phpcs:ignore WordPress.Security.NonceVerification.Missing
                // TODO: Rename $_product to $variation, to make it easier to understand what is what.
                $measurement_needed_value = $this->calculate_measurement_needed($product, $variation_id ? $_product : null);
                $measurement_needed_value_unit = wc_clean(wp_unslash($_POST['_measurement_needed_unit']));
                // phpcs:ignore WordPress.Security.NonceVerification.Missing
            } elseif (isset($cart_item_data['pricing_item_meta_data']['_measurement_needed_internal'])) {
                $measurement_needed_value = $cart_item_data['pricing_item_meta_data']['_measurement_needed_internal'];
                $measurement_needed_value_unit = $cart_item_data['pricing_item_meta_data']['_measurement_needed_unit_internal'];
            }
            if ($measurement_needed_value !== null) {
                $measurement_needed = new Measurement($measurement_needed_value_unit, (float) $measurement_needed_value);
                // get the product price
                $price = Product::calculate_price($_product, $measurement_needed_value, $measurement_needed_value_unit, \false, $settings);
                // save the product total price
                $cart_item_data['pricing_item_meta_data']['_price'] = $price;
                // save the total measurement (length, area, volume, etc)
                $cart_item_data['pricing_item_meta_data']['_measurement_needed'] = $measurement_needed->get_value();
                $cart_item_data['pricing_item_meta_data']['_measurement_needed_unit'] = $measurement_needed->get_unit();
            }
            // record the item quantity
            // NOTE: although it may be more ideal to record item quantity from the 'woocommerce_add_to_cart'
            // action in case 3rd party plugins modify it, we need to grab it early so prices can be calculated
            // as needed.  shikata ga nai
            $cart_item_data['pricing_item_meta_data']['_quantity'] = isset($_REQUEST['quantity']) ? (float) wc_clean(wp_unslash($_REQUEST['quantity'])) : 1;
            // the individual measurements (for simple calculators like the length or weight or area this will be the same as the measurement needed,
            // while for more complicated ones like area-dimension this will be the length and width, while measurement_needed will be the total area)
            // These are recorded so they can be displayed within the cart/checkout/admin
            foreach ($settings->get_calculator_measurements() as $measurement) {
                if (isset($_POST[$measurement->get_name() . '_needed'])) {
                    // phpcs:ignore WordPress.Security.NonceVerification.Missing
                    $measurement_needed = wc_clean(wp_unslash($_POST[$measurement->get_name() . '_needed']));
                    // phpcs:ignore WordPress.Security.NonceVerification.Missing
                    // if a user entered a float value without a 0 before the decimal dot, add the zero to ensure consistency
                    if (Helper::str_starts_with($measurement_needed, '.')) {
                        $measurement_needed = 0 . $measurement_needed;
                    }
                    $cart_item_data['pricing_item_meta_data'][$measurement->get_name()] = $measurement_needed;
                }
            }
        }
        return $cart_item_data;
    }
    /**
     * Calculates the total measurement needed.
     *
     * @since 3.4.0
     *
     * @param WC_Product $product product object
     * @param WC_Product_Variation|null $variation variation object or null if no variation
     * @return float
     */
    public function calculate_measurement_needed($product, $variation = null)
    {
        $settings = $this->settings_container->get($product);
        $measurement_type = $settings->get_calculator_type();
        $measurement_needed = null;
        if (!empty($this->measurements_needed) && is_array($this->measurements_needed)) {
            foreach ($this->measurements_needed as $measurement) {
                // convert to common unit
                $measurement_value = Measurement::convert($measurement['value'], $measurement['unit'], $measurement['common_unit']);
                if ('area-surface' === $measurement_type) {
                    // get dimensions
                    $length = Measurement::convert($this->measurements_needed['length']['value'], $this->measurements_needed['length']['unit'], $this->measurements_needed['length']['common_unit']);
                    $width = Measurement::convert($this->measurements_needed['width']['value'], $this->measurements_needed['width']['unit'], $this->measurements_needed['width']['common_unit']);
                    $height = Measurement::convert($this->measurements_needed['height']['value'], $this->measurements_needed['height']['unit'], $this->measurements_needed['height']['common_unit']);
                    $measurement_needed = 2 * ($length * $width + $width * $height + $length * $height);
                    /**
                     * Filters surface area value.
                     *
                     * @since 3.5.0
                     *
                     * @param float $surface_area The calculated surface area.
                     * @param WC_Product $product
                     * @param float $length
                     * @param float $width
                     * @param float $height
                     * @param WC_Product_Variation|null $variation variation object or null if not a variable product
                     */
                    $measurement_needed = apply_filters('fq_price_calculator_measurement_needed_surface_area', $measurement_needed, $product, $length, $width, $height, $variation);
                    break;
                }
                if ('area-linear' === $measurement_type) {
                    if (!$measurement_needed) {
                        // first or single measurement
                        $measurement_needed = 2 * $measurement_value;
                    } else {
                        // multiply to get either the area or volume measurement
                        $measurement_needed += 2 * $measurement_value;
                    }
                } elseif (!$measurement_needed) {
                    // first or single measurement
                    $measurement_needed = $measurement_value;
                } else {
                    // multiply to get either the area or volume measurement
                    $measurement_needed *= $measurement_value;
                }
            }
            // get common unit
            if ($product_measurement = Product::get_product_measurement($product, $settings)) {
                // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.FoundInControlStructure
                /** @type Measurement $measurement */
                list($measurement) = $settings->get_calculator_measurements();
                $product_measurement->set_common_unit($measurement->get_unit_common());
                /**
                 * Filters the calculated measurement needed.
                 *
                 * @param float $measurement_needed the calculated measurement needed.
                 * @param string $measurement_type the calculator type e.g. "area-linear"
                 * @param WC_Product $product
                 * @param Cart $this Cart instance
                 * @param WC_Product_Variation|null $variation variation object or null if not a variable product
                 *
                 *@since 3.5.2
                 */
                $measurement_needed = apply_filters('fq_price_calculator_measurement_needed', $measurement_needed, $measurement_type, $product, $this, $variation);
                // convert measurement to pricing unit
                $measurement_needed = Measurement::convert($measurement_needed, $product_measurement->get_unit_common(), $settings->get_pricing_unit());
            }
            $measurement_needed = $this->round_measurement_needed_by_increment_precision($measurement_needed, $settings);
        }
        return $measurement_needed;
    }
    /**
     * When dilling with mesaurement conversion, our calculations had to be rounded becouse
     * $mesurement_needed could not be precise (ex. sq. in to sq. ft. is 1/144 ~ 0,00694 is rounded becouse of big numbers
     * then when w go back from this 0.00694 x 144 we don't get 1 but 0.999..)
     *
     * The precision of rounding can not be constant for every settings,
     * resonable approach is to use the precision of the increment
     *
     * also becouse we can have different increments, we should depend on that with rounding
     */
    private function round_measurement_needed_by_increment_precision($measurement_needed, $settings)
    {
        $precision = self::DEFAULT_MEASUREMENT_NEEDED_ROUNDING_PRECISION;
        $increment = $settings->get_settings()['fq']['increment'] ?? '';
        if ($increment) {
            $precision = \strlen(\substr(\strrchr($increment, '.'), 1));
        }
        $measurement_needed = \wc_format_decimal($measurement_needed, $precision);
        return $measurement_needed;
    }
    /**
     * Persist our custom cart item data (if any) to the session
     *
     * @since 3.0
     * @param array $cart_item associative array of data representing a cart item (product)
     * @param array $values associative array of data for the cart item, currently in the session
     * @return array associative array of data representing a cart item (product)
     */
    public function get_cart_item_from_session($cart_item, $values): array
    {
        if (isset($values['pricing_item_meta_data'])) {
            $cart_item['pricing_item_meta_data'] = $values['pricing_item_meta_data'];
            $cart_item = $this->set_product_shipping_methods($cart_item);
        }
        return $cart_item;
    }
    /**
     * Adjust the price based on what dynamic pricing has calculated.  This adds compatibility
     * for WooCommerce Dynamic Pricing, at least for products without calculated quantity enabled.
     * That may be another whole can of worms.
     *
     * @since 3.1.3
     * @param float $adjusted_price the price calculated by dynamic pricing
     * @param string $cart_item_key the cart item key
     * @param float $original_price the original price prior to modification of dynamic pricing
     * @return float the price
     */
    public function dynamic_pricing_adjusted_price($adjusted_price, $cart_item_key, $original_price)
    {
        $cart_item_data = WC()->cart->cart_contents[$cart_item_key];
        if (isset($cart_item_data['pricing_item_meta_data']['_measurement_needed']) && $cart_item_data['pricing_item_meta_data']['_measurement_needed']) {
            /** @type WC_Product $product */
            $product = $cart_item_data['data'];
            $product->set_price($adjusted_price);
            // FIXME: we should pass $settings here
            $adjusted_price = Product::calculate_price($product, $cart_item_data['pricing_item_meta_data']['_measurement_needed'], $cart_item_data['pricing_item_meta_data']['_measurement_needed_unit']);
        }
        return $adjusted_price;
    }
    /**
     * Display any user-input product data in the cart
     *
     * @param array $data array of name/display pairs of data to display in the cart
     * @param array $item associative array of a cart item (product)
     *
     * @return array of name/display pairs of data to display in the cart
     * @since 3.0
     */
    public function display_product_data_in_cart(array $data, array $item): array
    {
        if (isset($item['pricing_item_meta_data'])) {
            $display_data = $this->humanize_cart_item_data($item, $item['pricing_item_meta_data']);
            foreach ($display_data as $name => $value) {
                $data[] = ['name' => $name, 'display' => $value, 'hidden' => \false];
            }
        }
        return $data;
    }
    /**
     * Add pricing calculator product custom user-input fields to the order item meta.
     *
     * This is a callback valid only in WooCommerce 2.7 or newer and is called
     * during the checkout process for each cart item added to the order.
     *
     * @internal
     *
     * @since 3.11.0
     * @param WC_Order_Item_Product $item product item object
     * @param string $cart_item_key cart item key, unused
     * @param array $values posted checkout values
     */
    public function set_order_item_meta($item, $cart_item_key, $values)
    {
        // pricing calculator item?
        if (isset($values['pricing_item_meta_data'])) {
            $display_data = $this->humanize_cart_item_data($values, $values['pricing_item_meta_data']);
            // set any user-input fields to the order item meta data (which can be displayed on the frontend)
            foreach ($display_data as $name => $value) {
                $item->add_meta_data($name, $value);
            }
            // persist the configured item measurement data such that the exact same item could be re-configured at a later date
            $measurement_data = $this->get_measurement_cart_item_data($values, $values['pricing_item_meta_data']);
            $item->add_meta_data('_fq_measurement_data', $measurement_data);
            $settings = $this->settings_container->get($item->get_product());
            if (isset($values['pricing_item_meta_data']['_quantity']) && $settings->is_pricing_inventory_enabled()) {
                // set the actual unit quantity (ie *2* fabrics at 3 ft each, rather than '6')
                add_action('woocommerce_new_order_item', [$this, 'save_actual_unit_quantity'], 10, 2);
            }
        }
    }
    /**
     * For a product with pricing calculator inventory enabled, save the
     * actual user-inputted unit quantity (e.g. qty = 2 [fabrics at 3 ft each, rather than 6])
     * after the checkout is processed.
     *
     * @internal
     *
     * @since 3.11.0
     * @param int $_ order item ID, unused
     * @param WC_Order_Item_Product $item
     */
    public function save_actual_unit_quantity($_, $item)
    {
        if (!$item instanceof WC_Order_Item_Product) {
            return;
        }
        $measurement_data = $item->get_meta('_fq_measurement_data');
        if (!empty($measurement_data['_quantity'])) {
            $item->set_quantity($measurement_data['_quantity']);
            $item->save();
        }
    }
    /**
     * For a product with pricing calculator inventory enabled, ensure
     * that order stock is reduced at checkout by the calculated amount multiplied
     * by the quantity ordered.
     *
     * This is required in WC 3.0 because the stock reduction happens *after*
     * we've already set the actual unit quantity (see the save_actual_unit_quantity()
     * method above) and WC retrieves the unit quantity instead of our calculated
     * quantity.
     *
     * @internal
     *
     * @since 3.11.1
     *
     * @param int|float $quantity quantity to reduce order stock by
     * @param WC_Order $_ order object, unused
     * @param WC_Order_item_Product $item
     * @return int|float
     */
    public function use_calculated_inventory_quantity($quantity, $_, $item)
    {
        $settings = $this->settings_container->get($item->get_product());
        if ($settings->is_pricing_inventory_enabled() && $measurement_data = $item->get_meta('_fq_measurement_data')) {
            // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.FoundInControlStructure
            if (!empty($measurement_data['_measurement_needed']) && !empty($measurement_data['_quantity'])) {
                $quantity = $measurement_data['_measurement_needed'] * $measurement_data['_quantity'];
            }
        }
        return $quantity;
    }
    public function set_product_shipping_methods($cart_item)
    {
        $product = $cart_item['data'];
        $settings = $this->settings_container->get($product);
        if ($settings->is_shipping_table_enabled()) {
            $measurement = new Measurement($cart_item['pricing_item_meta_data']['_measurement_needed_unit'], $cart_item['pricing_item_meta_data']['_measurement_needed']);
            $class_id = $settings->get_shipping_class_id($measurement);
            $class_id = \false === $class_id ? $product->get_shipping_class_id() : $class_id;
            $cart_item['data']->set_shipping_class_id($class_id);
        }
        return $cart_item;
    }
    /**
     * Recalculate the cart contents count by taking into account any
     * products that may have the pricing calculator inventory enabled and using
     * the actual product quantity, not the calculated quantity
     *
     * @since 3.7.0
     * @return int
     */
    public function set_cart_contents_count()
    {
        $count = 0;
        foreach (WC()->cart->get_cart() as $cart_item_key => $item) {
            $count += $this->get_item_quantity($item);
        }
        return $count;
    }
    /**
     * Recalculate the cart contents weight by taking into account any
     * products that may have the pricing calculator inventory enabled and using
     * the actual product quantity, not the calculated quantity
     *
     * @since 3.10.1
     *
     * @return float updated weight
     *
     * @deprecated since 2.0.0 - see WeightModifier class
     */
    public function set_cart_contents_weight()
    {
        $weight = 0;
        foreach (WC()->cart->get_cart() as $cart_item_key => $item) {
            $weight += (float) $item['data']->get_weight() * $this->get_item_quantity($item);
        }
        return $weight;
    }
    /**
     * Pricing calculator calculated weight handling
     *
     * This method is responsible for the Pricing Calculator
     * products calculated weight handling.  By default, a pricing calculator product's
     * weight will be defined as would any other, non-customizable product.  Meaning
     * that if you have a weight of '10 lbs' for custom-sized tiling, an item could
     * be of any area and still weigh 10 lbs, which probably isn't very realistic.
     *
     * With calculated weight enabled, that same weight of '10' would repesent
     * '10 lbs / sq ft' meaning that the total weight of an item is calculated based
     * on its weight ratio and total measurement.
     *
     * The implementation strategy used to achieve this is to hook into some critical
     * actions in the WC_Cart class, loop through the cart items and calculate and
     * set a weight on the relevant products.  Then when the various shipping
     * methods call the $product->get_weight() the correct, calculated weight will
     * be returned.
     *
     * @since 3.0
     *
     * @param WC_Cart $cart the cart object
     *
     * @deprecated since 2.0.0 - see WeightModifier class
     */
    public function calculate_product_weights($cart)
    {
        // loop through the cart items calculating the total weight for any pricing
        // calculator calculated weight products
        foreach ($cart->cart_contents as $cart_item_key => &$values) {
            /** @var WC_Product $product */
            $product = $values['data'];
            /** @var WC_Product $_product */
            $_product = $values['data'];
            // need the parent product to retrieve the calculator settings from
            if ($product->is_type('variation')) {
                $product = wc_get_product($product->get_parent_id());
            }
            $_product_weight = $_product->get_weight();
            if (isset($values['pricing_item_meta_data']['_measurement_needed_unit'], $values['pricing_item_meta_data']['_measurement_needed']) && Product::pricing_calculated_weight_enabled($_product)) {
                $settings = $this->settings_container->get($product);
                if ('weight' === $settings->get_calculator_type()) {
                    // now, the weight calculator products have to be handled specially
                    // since the customer is actually supplying the weight, but it will
                    // be in pricing units which may not be the same as the globally
                    // configured WooCommerce Weight Unit expected by other plugins and code
                    $supplied_weight = new Measurement($values['pricing_item_meta_data']['_measurement_needed_unit'], $values['pricing_item_meta_data']['_measurement_needed']);
                    $weight_value = $supplied_weight->get_value(get_option('woocommerce_weight_unit'));
                    // set the product weight as supplied by the customer, in WC Weight Units
                    $_product->set_weight($weight_value);
                } elseif (!empty($_product_weight)) {
                    // Record the configured weight per unit for future reference.
                    if (!isset($values['pricing_item_meta_data']['_weight'])) {
                        $values['pricing_item_meta_data']['_weight'] = $_product_weight;
                    }
                    $_product_weight = $values['pricing_item_meta_data']['_weight'] * $values['pricing_item_meta_data']['_measurement_needed'];
                    // Calculate the product weight = unit weight * total measurement
                    // (both will be in the same pricing units so we have say lbs/sq. ft. * sq. ft. = lbs)
                    $_product->set_weight($_product_weight);
                }
            }
        }
    }
    /**
     * Returns the cart item data for the given item being re-ordered.  This is
     * a somewhat complex process of re-configuring the product based on the
     * original measurements, taking into account unit changes.  We do not handle
     * calculator type changes at the moment; in fact there's probably no way
     * of accounting for this.  (actually we could handle calculator changes as
     * long as the calculator type was simplified, ie Area (L x W) -> Area,
     * but aside from that there's nothing we can do)
     *
     * @since 3.0
     * @param array $cart_item_data the cart item data
     * @param array $item the item
     * @param WC_Order $order the original order
     * @return array the cart item data
     */
    public function order_again_cart_item_data($cart_item_data, $item, $order)
    {
        // in case the previously ordered item was a variation, we should get the ID from the variation
        if (isset($item['variation_id']) && $item['variation_id'] > 0) {
            $product = wc_get_product($item['variation_id']);
        } elseif (isset($item['product_id']) && $item['product_id'] > 0) {
            $product = wc_get_product($item['product_id']);
        } else {
            $product = null;
        }
        // not a measurement product
        if (\false === Product::pricing_calculator_enabled($product) || !isset($item['item_meta']['_fq_measurement_data'])) {
            return $cart_item_data;
        }
        // WC 3.x compatibility fix
        $measurement_data = null;
        $measurement_data = $item['item_meta']['_fq_measurement_data'];
        // measurement data is not valid or doesn't exist
        if (!is_array($measurement_data)) {
            return $cart_item_data;
        }
        $settings = $this->settings_container->get($product);
        $measurements = $settings->get_calculator_measurements();
        // get the old product measurements, converting to the new measurement units as needed
        foreach ($measurements as $measurement) {
            if (isset($measurement_data[$measurement->get_name()])) {
                $current_unit = $measurement->get_unit();
                $measurement->set_value($measurement_data[$measurement->get_name()]['value']);
                $measurement->set_unit($measurement_data[$measurement->get_name()]['unit']);
                $cart_item_data['pricing_item_meta_data'][$measurement->get_name()] = $measurement->get_value($current_unit);
            }
        }
        $cart_item_data = $this->setup_measurement_overage_data($cart_item_data, $measurement_data['_measurement_needed'], $measurement_data['_measurement_needed_unit'], $product, $settings, \true);
        // the product total measurement
        $measurement_needed = new Measurement($measurement_data['_measurement_needed_unit'], $measurement_data['_measurement_needed']);
        // if this calculator uses pricing rules, retrieve the price based on the product measurements
        $rule_price = $settings->get_pricing_rules_price($measurement_needed);
        if ($rule_price) {
            $product->set_price($rule_price);
        }
        // calculate the price
        $price = $product->get_price('edit') * $measurement_needed->get_value($settings->get_pricing_unit());
        // is there a minimum price to use?
        $min_price = $product->get_meta('_fq_price_calculator_min_price');
        if (is_numeric($min_price) && $min_price > $price) {
            $price = $min_price;
        }
        // set the product price based on the price per unit and the total measurement
        $cart_item_data['pricing_item_meta_data']['_price'] = $price;
        // save the total measurement (length, area, volume, etc) in pricing units
        $cart_item_data['pricing_item_meta_data']['_measurement_needed'] = $measurement_needed->get_value();
        $cart_item_data['pricing_item_meta_data']['_measurement_needed_unit'] = $measurement_needed->get_unit();
        // pick up the item quantity which we set in order_again_item_set_quantity()
        if (isset($item['item_meta']['_quantity'][0])) {
            $cart_item_data['pricing_item_meta_data']['_quantity'] = $item['item_meta']['_quantity'][0];
        }
        return $cart_item_data;
    }
    /** API methods ******************************************************/
    /**
     * Setup measurement overage data for given cart item
     *
     * @param array       $cart_item_data
     * @param float       $measurement_needed_value
     * @param string      $measurement_needed_value_unit
     * @param WC_Product $_product
     * @param Settings    $settings
     * @param bool        $order_again
     *
     * @return array
     */
    public function setup_measurement_overage_data($cart_item_data, $measurement_needed_value, $measurement_needed_value_unit, $_product, $settings = null, $order_again = \false)
    {
        // get product settings if needed
        $settings = null === $settings ? new Settings($_product) : $settings;
        // if overage is enabled/set
        $pricing_overage_percentage = $settings->get_pricing_overage();
        if ($pricing_overage_percentage > 0) {
            if ($order_again) {
                // order again
                // calculate original price & overage value
                $measurement_needed_value_original = $measurement_needed_value / (1 + $pricing_overage_percentage);
                $measurement_needed_value_overage = $measurement_needed_value - $measurement_needed_value_original;
            } else {
                // new order
                $measurement_needed_value_overage = $measurement_needed_value * $pricing_overage_percentage;
                $measurement_needed_value_original = $measurement_needed_value;
            }
            // update cart item data
            $cart_item_data['pricing_item_meta_data']['_measurement_needed_original'] = $measurement_needed_value_original;
            $cart_item_data['pricing_item_meta_data']['_measurement_needed_overage'] = $measurement_needed_value_overage;
            $cart_item_data['pricing_item_meta_data']['_price_overage'] = Product::calculate_price($_product, $measurement_needed_value_overage, $measurement_needed_value_unit, $settings);
            $cart_item_data['pricing_item_meta_data']['_overage_percentage'] = $pricing_overage_percentage;
        }
        return $cart_item_data;
    }
    /**
     * API method to get the item price
     *
     * @since 3.1
     * @param array $item the cart item
     * @return float the item price
     */
    public function get_item_price($item)
    {
        // special case for calculated inventory products: the actual product price is held by _price (ie $10)
        // while the $product->get_price() value is the price per unit (ie $1 / foot)
        if (isset($item['pricing_item_meta_data']['_price']) && Product::pricing_calculator_inventory_enabled($item['data'])) {
            return $item['pricing_item_meta_data']['_price'];
        }
        // return the regular item price
        return $item['data']->get_price('edit');
    }
    /**
     * Gets the item quantity
     *
     * @since 3.1
     * @param array $item the cart item
     * @return int the item quantity
     */
    public function get_item_quantity($item)
    {
        $settings = $this->settings_container->get($item['data']);
        // special case for calculated inventory products: the actual quantity (ie *1* item 10 feet long)
        // is held in _quantity while $item['quantity'] would be '10' in this example
        if (isset($item['pricing_item_meta_data']['_quantity']) && $settings->is_pricing_inventory_enabled()) {
            return $item['pricing_item_meta_data']['_quantity'];
        }
        // return the regular item quantity
        return $item['quantity'];
    }
    /** Helper methods ******************************************************/
    /**
     * Turn the cart item data into an array that fully describes the configured
     * item such that it can be re-created again in the future as needed.  This
     * is not possible from the humanized cart item data
     *
     * @since 3.0
     * @param array $item cart item
     * @param array $cart_item_data the cart item data
     * @return array measurement cart item data
     */
    private function get_measurement_cart_item_data($item, $cart_item_data)
    {
        $measurement_data = [];
        $product = $item['data'];
        $settings = $this->settings_container->get($product);
        foreach ($settings->get_calculator_measurements() as $measurement) {
            if (isset($cart_item_data[$measurement->get_name()])) {
                $measurement_data[$measurement->get_name()] = ['value' => $cart_item_data[$measurement->get_name()], 'unit' => $measurement->get_unit()];
            }
        }
        // save the total measurement/unit
        $measurement_data['_measurement_needed'] = $cart_item_data['_measurement_needed'];
        $measurement_data['_measurement_needed_unit'] = $cart_item_data['_measurement_needed_unit'];
        // special case for calculated inventory products: the actual quantity (ie *1* item 10 feet long)
        // is held in _quantity while $item['quantity'] would be '10' in this example
        if (isset($cart_item_data['_quantity']) && $settings->is_pricing_inventory_enabled()) {
            $measurement_data['_quantity'] = $cart_item_data['_quantity'];
        }
        return $measurement_data;
    }
    /**
     * Turn the cart item data into human-readable key/value pairs for
     * display in the cart
     *
     * @since 3.0
     * @param array $item cart item
     * @param array $cart_item_data the cart item data
     * @return array human-readable cart item data
     */
    private function humanize_cart_item_data($item, $cart_item_data)
    {
        $new_cart_item_data = [];
        $product = $item['data'];
        $settings = $this->settings_container->get($product);
        $calculator_measurements = $settings->get_calculator_measurements();
        foreach ($calculator_measurements as $measurement) {
            $measurement_name = $measurement->get_name();
            if (isset($cart_item_data[$measurement_name])) {
                // if the measurement has a set of available options, get the option label for display, if we can determine it
                // (this way we display "1/8" rather than "0.125", etc)
                $measurement_options = $measurement->get_options();
                if (count($measurement_options) > 0) {
                    foreach ($measurement_options as $value => $label) {
                        if ($cart_item_data[$measurement_name] === $value) {
                            $cart_item_data[$measurement_name] = $label;
                        }
                    }
                }
                $label = $measurement->get_unit_label() ? sprintf('%1$s (%2$s)', $measurement->get_label(), __($measurement->get_unit_label(), 'flexible-quantity-measurement-price-calculator-for-woocommerce')) : $measurement->get_label();
                $new_cart_item_data[$label] = $cart_item_data[$measurement_name];
            }
        }
        // render calculator single measurement overage
        if (isset($cart_item_data['_measurement_needed_overage']) && 1 === count($calculator_measurements)) {
            $measurement = array_shift($calculator_measurements);
            $new_cart_item_data[sprintf(__('Overage Estimate (%s)', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), $measurement->get_unit_label())] = $cart_item_data['_measurement_needed_overage'];
        }
        // render the total measurement if this is a derived calculator (ie "Area (sq. ft.): 10" if the calculator is Area (LxW))
        if (isset($cart_item_data['_measurement_needed']) && $settings->is_calculator_type_derived() && $product_measurement = Product::get_product_measurement($product, $settings)) {
            // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.FoundInControlStructure
            $product_measurement->set_unit($cart_item_data['_measurement_needed_unit']);
            $product_measurement->set_value($cart_item_data['_measurement_needed']);
            $total_amount_text = apply_filters('fq_price_calculator_total_amount_text', $product_measurement->get_unit_label() ? sprintf(__('Total %1$s (%2$s)', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), $product_measurement->get_label(), __($product_measurement->get_unit_label(), 'flexible-quantity-measurement-price-calculator-for-woocommerce')) : sprintf(__('Total %s', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), $product_measurement->get_label()), $item);
            if (isset($cart_item_data['_measurement_needed_overage'])) {
                $overage_amount_text = apply_filters('fq_price_calculator_overage_amount_text', $product_measurement->get_unit_label() ? sprintf(__('Overage %1$s (%2$s)', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), $product_measurement->get_label(), $product_measurement->get_unit_label()) : sprintf(__('Overage %s', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), $product_measurement->get_label()), $item);
                $new_cart_item_data[$overage_amount_text] = $cart_item_data['_measurement_needed_overage'];
            }
            $new_cart_item_data[$total_amount_text] = apply_filters('fq_price_calculator_cart_item_data_total_amount_value', $product_measurement->get_value());
        }
        // render pricing overage estimate
        if (isset($cart_item_data['_price_overage'], $cart_item_data['_overage_percentage'])) {
            $new_cart_item_data[sprintf(__('Overage Cost (%s%%)', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), $cart_item_data['_overage_percentage'] * 100)] = wc_price($cart_item_data['_price_overage']);
        }
        return $new_cart_item_data;
    }
    /**
     * Get the measurements needed
     *
     * @since 3.10.1
     * @return array an associative array of measurements needed
     */
    public function get_measurements_needed()
    {
        return $this->measurements_needed;
    }
    /**
     * Clear persistent data cookie data
     *
     * @param string $cart_item_key
     * @param int $product_id
     *
     * @return void
     */
    public function clear_inputs_cookie($cart_item_key, $product_id)
    {
        $product = wc_get_product($product_id);
        $cookie_name = 'wc_price_calc_inputs_' . $product->get_id();
        if (array_key_exists($cookie_name, $_COOKIE)) {
            unset($_COOKIE[$cookie_name]);
            setcookie($cookie_name, ' ', time() - \YEAR_IN_SECONDS, '/');
        }
    }
    /**
     * Unique cart id is now generated with woocommerce quantity value inside $cart item data.
     * That means if someone adds product (with same fq quantity) but different WC quantity
     * then it will add new item in the cart. This filter fixes this issue.
     *
     * @param string $cart_id
     * @param int    $product_id
     * @param int    $variation_id
     * @param array  $variation
     * @param array  $cart_item_data
     *
     * @return string
     */
    public function get_cart_id($cart_id, $product_id, $variation_id, $variation, $cart_item_data)
    {
        // remove _quantity from item_data, as it causes issue
        unset($cart_item_data['pricing_item_meta_data']['_quantity']);
        // Remove the filter temporarily to prevent an infinite loop.
        \remove_filter('woocommerce_cart_id', [$this, 'get_cart_id'], 10, 5);
        $new_cart_id = WC()->cart->generate_cart_id($product_id, $variation_id, $variation, $cart_item_data);
        // Re-add the filter.
        \add_filter('woocommerce_cart_id', [$this, 'get_cart_id'], 10, 5);
        return $new_cart_id;
    }
    /**
     * Checks if the measurement value is valid based on a specified increment.
     * Basically, checks if the measurement is a multiple of the increment.
     *
     * @param float $mesurement_needed The measurement value
     * @param float $increment The increment value
     * @return bool
     */
    private function is_mesurement_value_valid_by_increment(float $mesurement_needed, float $increment)
    {
        if ($increment == 0) {
            return \false;
        }
        if ($increment > $mesurement_needed) {
            return \false;
        }
        $mesurement_needed = round($mesurement_needed * 10000);
        $increment = round($increment * 10000);
        return $mesurement_needed % $increment === 0;
    }
}
