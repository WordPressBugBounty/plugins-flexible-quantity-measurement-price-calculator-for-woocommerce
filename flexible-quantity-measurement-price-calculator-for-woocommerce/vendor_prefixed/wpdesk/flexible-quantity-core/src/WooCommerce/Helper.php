<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce;

use stdClass;
use WC_Order;
use WC_Order_Item_Product;
use WP_Screen;
use XMLWriter;
class Helper
{
    /** Encoding used for mb_*() string functions */
    const MB_ENCODING = 'UTF-8';
    /** String manipulation functions (all multi-byte safe) ***************/
    /**
     * Returns true if the haystack string starts with needle
     * Note: case-sensitive
     *
     * @param string $haystack
     * @param string $needle
     *
     * @return bool
     * @since 2.2.0
     */
    public static function str_starts_with($haystack, $needle)
    {
        if (self::multibyte_loaded()) {
            if ('' === $needle) {
                return \true;
            }
            return 0 === mb_strpos($haystack, $needle, 0, self::MB_ENCODING);
        } else {
            $needle = self::str_to_ascii($needle);
            if ('' === $needle) {
                return \true;
            }
            return 0 === strpos(self::str_to_ascii($haystack), self::str_to_ascii($needle));
        }
    }
    /**
     * Return true if the haystack string ends with needle
     * Note: case-sensitive
     *
     * @param string $haystack
     * @param string $needle
     *
     * @return bool
     * @since 2.2.0
     */
    public static function str_ends_with($haystack, $needle)
    {
        if ('' === $needle) {
            return \true;
        }
        if (self::multibyte_loaded()) {
            return mb_substr($haystack, -mb_strlen($needle, self::MB_ENCODING), null, self::MB_ENCODING) === $needle;
        } else {
            $haystack = self::str_to_ascii($haystack);
            $needle = self::str_to_ascii($needle);
            return substr($haystack, -strlen($needle)) === $needle;
        }
    }
    /**
     * Returns true if the needle exists in haystack
     * Note: case-sensitive
     *
     * @param string $haystack
     * @param string $needle
     *
     * @return bool
     * @since 2.2.0
     */
    public static function str_exists($haystack, $needle)
    {
        if (self::multibyte_loaded()) {
            if ('' === $needle) {
                return \false;
            }
            return \false !== mb_strpos($haystack, $needle, 0, self::MB_ENCODING);
        } else {
            $needle = self::str_to_ascii($needle);
            if ('' === $needle) {
                return \false;
            }
            return \false !== strpos(self::str_to_ascii($haystack), self::str_to_ascii($needle));
        }
    }
    /**
     * Truncates a given $string after a given $length if string is longer than
     * $length. The last characters will be replaced with the $omission string
     * for a total length not exceeding $length
     *
     * @param string $string   text to truncate
     * @param int    $length   total desired length of string, including omission
     * @param string $omission omission text, defaults to '...'
     *
     * @return string
     * @since 2.2.0
     */
    public static function str_truncate($string, $length, $omission = '...')
    {
        if (self::multibyte_loaded()) {
            // bail if string doesn't need to be truncated
            if (mb_strlen($string, self::MB_ENCODING) <= $length) {
                return $string;
            }
            $length -= mb_strlen($omission, self::MB_ENCODING);
            return mb_substr($string, 0, $length, self::MB_ENCODING) . $omission;
        } else {
            $string = self::str_to_ascii($string);
            // bail if string doesn't need to be truncated
            if (strlen($string) <= $length) {
                return $string;
            }
            $length -= strlen($omission);
            return substr($string, 0, $length) . $omission;
        }
    }
    /**
     * Returns a string with all non-ASCII characters removed. This is useful
     * for any string functions that expect only ASCII chars and can't
     * safely handle UTF-8. Note this only allows ASCII chars in the range
     * 33-126 (newlines/carriage returns are stripped)
     *
     * @param string $string string to make ASCII
     *
     * @return string
     * @since 2.2.0
     */
    public static function str_to_ascii($string)
    {
        // strip ASCII chars 32 and under
        $string = filter_var($string, \FILTER_SANITIZE_STRING, \FILTER_FLAG_STRIP_LOW);
        // strip ASCII chars 127 and higher
        return filter_var($string, \FILTER_SANITIZE_STRING, \FILTER_FLAG_STRIP_HIGH);
    }
    /**
     * Return a string with insane UTF-8 characters removed, like invisible
     * characters, unused code points, and other weirdness. It should
     * accept the common types of characters defined in Unicode.
     * The following are allowed characters:
     * p{L} - any kind of letter from any language
     * p{Mn} - a character intended to be combined with another character without taking up extra space (e.g. accents,
     * umlauts, etc.) p{Mc} - a character intended to be combined with another character that takes up extra space
     * (vowel signs in many Eastern languages) p{Nd} - a digit zero through nine in any script except ideographic
     * scripts p{Zs} - a whitespace character that is invisible, but does take up space p{P} - any kind of punctuation
     * character p{Sm} - any mathematical symbol p{Sc} - any currency sign pattern definitions from
     * http://www.regular-expressions.info/unicode.html
     *
     * @param string $string
     *
     * @return string
     * @since 4.0.0
     */
    public static function str_to_sane_utf8($string)
    {
        $sane_string = preg_replace('/[^\p{L}\p{Mn}\p{Mc}\p{Nd}\p{Zs}\p{P}\p{Sm}\p{Sc}]/u', '', $string);
        // preg_replace with the /u modifier can return null or false on failure
        return is_null($sane_string) || \false === $sane_string ? $string : $sane_string;
    }
    /**
     * Helper method to check if the multibyte extension is loaded, which
     * indicates it's safe to use the mb_*() string methods
     *
     * @return bool
     * @since 2.2.0
     */
    protected static function multibyte_loaded()
    {
        return extension_loaded('mbstring');
    }
    /** Array functions ***************************************************/
    /**
     * Insert the given element after the given key in the array
     * Sample usage:
     * given
     * array( 'item_1' => 'foo', 'item_2' => 'bar' )
     * array_insert_after( $array, 'item_1', array( 'item_1.5' => 'w00t' ) )
     * becomes
     * array( 'item_1' => 'foo', 'item_1.5' => 'w00t', 'item_2' => 'bar' )
     *
     * @param array  $array      array to insert the given element into
     * @param string $insert_key key to insert given element after
     * @param array  $element    element to insert into array
     *
     * @return array
     * @since 2.2.0
     */
    public static function array_insert_after(array $array, $insert_key, array $element)
    {
        $new_array = [];
        foreach ($array as $key => $value) {
            $new_array[$key] = $value;
            if ($insert_key == $key) {
                foreach ($element as $k => $v) {
                    $new_array[$k] = $v;
                }
            }
        }
        return $new_array;
    }
    /**
     * Convert array into XML by recursively generating child elements
     * First instantiate a new XML writer object:
     * $xml = new XMLWriter();
     * Open in memory (alternatively you can use a local URI for file output)
     * $xml->openMemory();
     * Then start the document
     * $xml->startDocument( '1.0', 'UTF-8' );
     * Don't forget to end the document and output the memory
     * $xml->endDocument();
     * $your_xml_string = $xml->outputMemory();
     *
     * @param XMLWriter    $xml_writer    XML writer instance
     * @param string|array $element_key   name for element, e.g. <per_page>
     * @param string|array $element_value value for element, e.g. 100
     *
     * @since 2.2.0
     */
    public static function array_to_xml($xml_writer, $element_key, $element_value = [])
    {
        if (is_array($element_value)) {
            // handle attributes
            if ('@attributes' === $element_key) {
                foreach ($element_value as $attribute_key => $attribute_value) {
                    $xml_writer->startAttribute($attribute_key);
                    $xml_writer->text($attribute_value);
                    $xml_writer->endAttribute();
                }
                return;
            }
            // handle multi-elements (e.g. multiple <Order> elements)
            if (is_numeric(key($element_value))) {
                // recursively generate child elements
                foreach ($element_value as $child_element_key => $child_element_value) {
                    $xml_writer->startElement($element_key);
                    foreach ($child_element_value as $sibling_element_key => $sibling_element_value) {
                        self::array_to_xml($xml_writer, $sibling_element_key, $sibling_element_value);
                    }
                    $xml_writer->endElement();
                }
            } else {
                // start root element
                $xml_writer->startElement($element_key);
                // recursively generate child elements
                foreach ($element_value as $child_element_key => $child_element_value) {
                    self::array_to_xml($xml_writer, $child_element_key, $child_element_value);
                }
                // end root element
                $xml_writer->endElement();
            }
        } else if ('@value' === $element_key) {
            $xml_writer->text($element_value);
        } else if (\false !== strpos($element_value, '<') || \false !== strpos($element_value, '>')) {
            $xml_writer->startElement($element_key);
            $xml_writer->writeCdata($element_value);
            $xml_writer->endElement();
        } else {
            $xml_writer->writeElement($element_key, $element_value);
        }
    }
    /** Number helper functions *******************************************/
    /**
     * Format a number with 2 decimal points, using a period for the decimal
     * separator and no thousands separator.
     * Commonly used for payment gateways which require amounts in this format.
     *
     * @param float $number
     *
     * @return string
     * @since 3.0.0
     */
    public static function number_format($number)
    {
        return number_format((float) $number, 2, '.', '');
    }
    /** WooCommerce helper functions **************************************/
    /**
     * Determines if an order contains only virtual products.
     *
     * @param WC_Order $order the order object
     *
     * @return bool
     * @since 4.5.0
     */
    public static function is_order_virtual(WC_Order $order)
    {
        $is_virtual = \true;
        /** @var WC_Order_Item_Product $item */
        foreach ($order->get_items() as $item) {
            $product = $item->get_product();
            // once we've found one non-virtual product we know we're done, break out of the loop
            if ($product && !$product->is_virtual()) {
                $is_virtual = \false;
                break;
            }
        }
        return $is_virtual;
    }
    /**
     * Get the count of notices added, either for all notices (default) or for one
     * particular notice type specified by $notice_type.
     * WC notice functions are not available in the admin
     *
     * @param string $notice_type The name of the notice type - either error, success or notice. [optional]
     *
     * @return int
     * @since 3.0.2
     */
    public static function wc_notice_count($notice_type = '')
    {
        if (function_exists('wc_notice_count')) {
            return wc_notice_count($notice_type);
        }
        return 0;
    }
    /**
     * Add and store a notice.
     * WC notice functions are not available in the admin
     *
     * @param string $message     The text to display in the notice.
     * @param string $notice_type The singular name of the notice type - either error, success or notice. [optional]
     *
     * @since 3.0.2
     */
    public static function wc_add_notice($message, $notice_type = 'success')
    {
        if (function_exists('wc_add_notice')) {
            wc_add_notice($message, $notice_type);
        }
    }
    /**
     * Print a single notice immediately
     * WC notice functions are not available in the admin
     *
     * @param string $message     The text to display in the notice.
     * @param string $notice_type The singular name of the notice type - either error, success or notice. [optional]
     *
     * @since 3.0.2
     */
    public static function wc_print_notice($message, $notice_type = 'success')
    {
        if (function_exists('wc_print_notice')) {
            wc_print_notice($message, $notice_type);
        }
    }
    /**
     * Gets the full URL to the log file for a given $handle
     *
     * @param string $handle log handle
     *
     * @return string URL to the WC log file identified by $handle
     * @since 4.0.0
     */
    public static function get_wc_log_file_url($handle)
    {
        return admin_url(sprintf('admin.php?page=wc-status&tab=logs&log_file=%s-%s-log', $handle, sanitize_file_name(wp_hash($handle))));
    }
    /**
     * Gets the current WordPress site name.
     * This is helpful for retrieving the actual site name instead of the
     * network name on multisite installations.
     *
     * @return string
     * @since 4.6.0
     */
    public static function get_site_name()
    {
        return is_multisite() ? get_blog_details()->blogname : get_bloginfo('name');
    }
    /** Misc functions ****************************************************/
    /**
     * Gets the WordPress current screen.
     *
     * @return WP_Screen|null
     * @since 5.4.2
     * @see   get_current_screen() replacement which is always available, unlike the WordPress core function
     */
    public static function get_current_screen()
    {
        global $current_screen;
        return $current_screen ?: null;
    }
    /**
     * Checks if the current screen matches a specified ID.
     * This helps avoiding using the get_current_screen() function which is not always available,
     * or setting the substitute global $current_screen every time a check needs to be performed.
     *
     * @param string $id   id (or property) to compare
     * @param string $prop optional property to compare, defaults to screen id
     *
     * @return bool
     * @since 5.4.2
     */
    public static function is_current_screen($id, $prop = 'id')
    {
        global $current_screen;
        return isset($current_screen->{$prop}) && $id === $current_screen->{$prop};
    }
    /**
     * Convert a 2-character country code into its 3-character equivalent, or
     * vice-versa, e.g.
     * 1) given USA, returns US
     * 2) given US, returns USA
     *
     * @param string $code ISO-3166-alpha-2 or ISO-3166-alpha-3 country code
     *
     * @return string country code
     * @since      4.2.0
     * @deprecated 5.4.3
     */
    public static function convert_country_code($code)
    {
        wc_deprecated_function(__METHOD__, '5.4.3', Country_Helper::class . '::convert_alpha_country_code()');
        return Country_Helper::convert_alpha_country_code($code);
    }
    /**
     * Displays a notice if the provided hook has not yet run.
     *
     * @param string $hook    action hook to check
     * @param string $method  method/function name
     * @param string $version version the notice was added
     *
     * @since 5.2.0
     */
    public static function maybe_doing_it_early($hook, $method, $version)
    {
        if (!did_action($hook)) {
            wc_doing_it_wrong($method, "This should only be called after '{$hook}'", $version);
        }
    }
    /**
     * Triggers a PHP error.
     * This wrapper method ensures AJAX isn't broken in the process.
     *
     * @param string $message the error message
     * @param int    $type    Optional. The error type. Defaults to E_USER_NOTICE
     *
     * @since 4.6.0
     */
    public static function trigger_error($message, $type = \E_USER_NOTICE)
    {
        //phpcs:ignore
        if (is_callable('is_ajax') && is_ajax()) {
            switch ($type) {
                case \E_USER_NOTICE:
                    $prefix = 'Notice: ';
                    break;
                case \E_USER_WARNING:
                    $prefix = 'Warning: ';
                    break;
                default:
                    $prefix = '';
            }
            error_log($prefix . $message);
        } else {
            trigger_error($message, $type);
            //phpcs:ignore
        }
    }
    /**
     * Checks if a given product is variable and has at least one variation with sock management enabled.
     *
     * @param \WC_Product $product
     *
     * @return bool
     * @since 3.18.2
     */
    public static function is_variable_product_with_stock_managed($product)
    {
        if (!$product instanceof \WC_Product || !$product->is_type('variable')) {
            return \false;
        }
        foreach ($product->get_children() as $variation_id) {
            $variation = wc_get_product($variation_id);
            if ($variation && $variation->get_manage_stock()) {
                return \true;
            }
        }
        return \false;
    }
}
