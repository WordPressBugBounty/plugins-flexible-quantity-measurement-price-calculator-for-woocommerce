<?php

namespace WDFQVendorFree;

/**
 * @var \WPDesk\Library\FlexibleQuantityCore\WooCommerce\Settings $settings
 */
// Perimeter (2 * L + 2 * W)
echo '<div id="area-linear_measurements" class="measurement_fields">';
\woocommerce_wp_checkbox(['id' => '_measurement_area-linear_pricing', 'value' => $settings['area-linear']['pricing']['enabled'], 'class' => 'checkbox _measurement_pricing', 'label' => \__('Show Product Price Per Unit', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'description' => \__('Check this box to display product pricing per unit on the frontend', 'flexible-quantity-measurement-price-calculator-for-woocommerce')]);
echo '<div id="_measurement_area-linear_pricing_fields" class="_measurement_pricing_fields" style="display:none;">';
\woocommerce_wp_text_input(['id' => '_measurement_area-linear_pricing_label', 'value' => $settings['area-linear']['pricing']['label'], 'label' => \__('Pricing Label', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'description' => \__('Label to display next to the product price (defaults to pricing unit)', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'desc_tip' => \true]);
\woocommerce_wp_select(['id' => '_measurement_area-linear_pricing_unit', 'value' => $settings['area-linear']['pricing']['unit'], 'class' => '_measurement_pricing_unit', 'label' => \__('Pricing Unit', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'options' => $measurement_units['dimension'], 'description' => \__('Unit to define pricing in', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'desc_tip' => \true]);
\woocommerce_wp_checkbox(['id' => '_measurement_area-linear_pricing_calculator_enabled', 'class' => 'checkbox _measurement_pricing_calculator_enabled', 'value' => $settings['area-linear']['pricing']['calculator']['enabled'], 'label' => \__('Calculated Price', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'description' => \__('Check this box to define product pricing per unit and allow customers to provide custom measurements', 'flexible-quantity-measurement-price-calculator-for-woocommerce')]);
\woocommerce_wp_checkbox(['id' => '_measurement_area-linear_pricing_weight_enabled', 'value' => $settings['area-linear']['pricing']['weight']['enabled'], 'class' => 'checkbox _measurement_pricing_weight_enabled', 'wrapper_class' => $pricing_weight_wrapper_class . ' _measurement_pricing_calculator_fields', 'label' => \__('Calculated Weight', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'description' => \__('Check this box to define the product weight per unit and calculate the item weight based on the product area', 'flexible-quantity-measurement-price-calculator-for-woocommerce')]);
\woocommerce_wp_checkbox(['id' => '_measurement_area-linear_pricing_inventory_enabled', 'value' => $settings['area-linear']['pricing']['inventory']['enabled'], 'class' => 'checkbox _measurement_pricing_inventory_enabled', 'wrapper_class' => 'stock_fields _measurement_pricing_calculator_fields', 'label' => \__('Calculated Inventory', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'description' => \__('Check this box to define inventory per unit and calculate inventory based on the product area', 'flexible-quantity-measurement-price-calculator-for-woocommerce')]);
\WDFQVendorFree\fq_price_calculator_overage_input('area-linear', $settings);
echo '</div>';
echo '<hr/>';
\woocommerce_wp_text_input(['id' => '_measurement_area-linear_length_label', 'value' => $settings['area-linear']['length']['label'], 'label' => \__('Length Label', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'description' => \__('Length input field label to display on the frontend', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'desc_tip' => \true]);
\woocommerce_wp_select(['id' => '_measurement_area-linear_length_unit', 'value' => $settings['area-linear']['length']['unit'], 'label' => \__('Length Unit', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'options' => $measurement_units['dimension'], 'description' => \__('The frontend length input field unit', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'desc_tip' => \true]);
\WDFQVendorFree\fq_price_calculator_attributes_inputs(['measurement' => 'area-linear', 'input_name' => 'length', 'input_label' => \__('Length', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'settings' => $settings, 'limited_field' => '_measurement_area-linear_length_options']);
\woocommerce_wp_text_input(['id' => '_measurement_area-linear_length_options', 'value' => \WDFQVendorFree\fq_price_calculator_get_options_value($settings['area-linear']['length']['options']), 'wrapper_class' => '_measurement_pricing_calculator_fields', 'label' => \__('Length Options', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'description' => \WDFQVendorFree\fq_price_calculator_get_options_tooltip(), 'desc_tip' => \true]);
echo '<hr/>';
\woocommerce_wp_text_input(['id' => '_measurement_area-linear_width_label', 'value' => $settings['area-linear']['width']['label'], 'label' => \__('Width Label', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'description' => \__('Width input field label to display on the frontend', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'desc_tip' => \true]);
\woocommerce_wp_select(['id' => '_measurement_area-linear_width_unit', 'value' => $settings['area-linear']['width']['unit'], 'label' => \__('Width Unit', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'options' => $measurement_units['dimension'], 'description' => \__('The frontend width input field unit', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'desc_tip' => \true]);
\WDFQVendorFree\fq_price_calculator_attributes_inputs(['measurement' => 'area-linear', 'input_name' => 'width', 'input_label' => \__('Width', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'settings' => $settings, 'limited_field' => '_measurement_area-linear_width_options']);
\woocommerce_wp_text_input(['id' => '_measurement_area-linear_width_options', 'value' => \WDFQVendorFree\fq_price_calculator_get_options_value($settings['area-linear']['width']['options']), 'wrapper_class' => '_measurement_pricing_calculator_fields', 'label' => \__('Width Options', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'description' => \WDFQVendorFree\fq_price_calculator_get_options_tooltip(), 'desc_tip' => \true]);
echo '</div>';