<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Overwrite;

use Exception;
use WC_Product;
/**
 * Contains validation logic adapted from WC_Cart::add_to_cart() method,
 * specifically for calculating inventory plugin option.
 */
class CartStockValidator
{
    public function validate_enough_stock(WC_Product $product_data, float $quantity): void
    {
        if (!$product_data->has_enough_stock($quantity)) {
            $stock_quantity = $product_data->get_stock_quantity();
            $message = sprintf(__('You cannot add that amount of "%1$s" to the cart because there is not enough stock (%2$s remaining).', 'woocommerce'), $product_data->get_name(), wc_format_stock_quantity_for_display($stock_quantity, $product_data));
            $message = apply_filters('woocommerce_cart_product_not_enough_stock_message', $message, $product_data, $stock_quantity);
            throw new Exception($message);
        }
        if ($product_data->managing_stock()) {
            $products_qty_in_cart = $this->get_cart_item_quantities();
            if ($this->is_stock_insufficient_considering_cart($product_data, $quantity, $products_qty_in_cart)) {
                $stock_quantity = $product_data->get_stock_quantity();
                $stock_quantity_in_cart = $products_qty_in_cart[$product_data->get_stock_managed_by_id()];
                $wp_button_class = wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : '';
                $message = sprintf('%s <a href="%s" class="button wc-forward%s">%s</a>', sprintf(__('You cannot add that amount to the cart &mdash; we have %1$s in stock and you already have %2$s in your cart.', 'woocommerce'), wc_format_stock_quantity_for_display($stock_quantity, $product_data), wc_format_stock_quantity_for_display($stock_quantity_in_cart, $product_data)), esc_url(wc_get_cart_url()), esc_attr($wp_button_class), __('View cart', 'woocommerce'));
                $message = apply_filters('woocommerce_cart_product_not_enough_stock_already_in_cart_message', $message, $product_data, $stock_quantity, $stock_quantity_in_cart);
                throw new Exception($message);
            }
        }
    }
    /**
     * Checks if the stock is insufficient when considering items already in the cart.
     *
     * @param array<int, float> $products_qty_in_cart
     */
    private function is_stock_insufficient_considering_cart(WC_Product $product_data, float $quantity, array $products_qty_in_cart): bool
    {
        $stock_managed_by_id = $product_data->get_stock_managed_by_id();
        if (!isset($products_qty_in_cart[$stock_managed_by_id])) {
            return \false;
        }
        $total_quantity_required = $products_qty_in_cart[$stock_managed_by_id] + $quantity;
        return !$product_data->has_enough_stock($total_quantity_required);
    }
    /**
     * Similar to WC_Cart::get_cart_item_quantities(), but
     * adjusted to account flexible quantity measurements.
     *
     * @return array<int, float>
     */
    public function get_cart_item_quantities(): array
    {
        $quantities = [];
        foreach (WC()->cart->get_cart() as $values) {
            $product = $values['data'];
            $quantity = $values['quantity'];
            if (isset($values['pricing_item_meta_data']['_measurement_needed'])) {
                $quantity = $quantity * (float) $values['pricing_item_meta_data']['_measurement_needed'];
            }
            $quantities[$product->get_stock_managed_by_id()] = isset($quantities[$product->get_stock_managed_by_id()]) ? $quantities[$product->get_stock_managed_by_id()] + $quantity : $quantity;
        }
        return $quantities;
    }
}
