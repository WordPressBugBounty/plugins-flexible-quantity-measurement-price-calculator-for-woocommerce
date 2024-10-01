<?php

namespace WDFQVendorFree;

/**
 * Template for the Dimensions section.
 *
 * @var string $dimension_slug
 * @var string $type_field_label
 * @var SettingsBag $settings
 * @var array $units
 */
?>
<div class="fq-field-type fq-field-<?php 
echo \esc_attr($dimension_slug);
?>">
	<div class="flex-row-container">
		<div class="single-column">
		<?php 
\woocommerce_wp_select(['id' => 'fq_dec_' . $dimension_slug . '_type', 'name' => 'fq[decimals][' . $dimension_slug . '][type]', 'value' => $settings->getString('type', 'fixed'), 'placeholder' => '', 'class' => 'wqm-select fq_field_type_selector fq_dec_' . $dimension_slug, 'label' => \esc_html($type_field_label), 'options' => ['fixed' => \esc_html__('Fixed value', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'user' => \esc_html__('User value', 'flexible-quantity-measurement-price-calculator-for-woocommerce')]]);
?>
		</div>
	</div>


	<div class="flex-row-container decimals-fields-with-labels fixed-fields">
		<div class="flex-row-item">
		<?php 
\woocommerce_wp_text_input(['id' => 'fq_dec_fixed_' . $dimension_slug . '_label', 'name' => 'fq[decimals][' . $dimension_slug . '][fixed][label]', 'value' => $settings->bag('fixed')->getString('label'), 'class' => 'fq_dec_fixed_' . $dimension_slug . '_label', 'wrapper_class' => 'myclass', 'label' => \esc_html__('Field label', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'desc_tip' => \true, 'description' => \esc_html__('Enter the name for the dimension field label.', 'flexible-quantity-measurement-price-calculator-for-woocommerce')]);
?>
		</div>

		<div class="flex-row-item">
		<?php 
\woocommerce_wp_select(['id' => 'fq_dec_fixed_' . $dimension_slug . '_unit', 'name' => 'fq[decimals][' . $dimension_slug . '][fixed][unit]', 'value' => $settings->bag('fixed')->getString('unit'), 'class' => 'wqm-select fq_dec_fixed_' . $dimension_slug . '_unit', 'label' => \esc_html__('Unit of measure', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'options' => $units, 'desc_tip' => \true, 'description' => \esc_html__('Choose the unit of measure for the dimension.', 'flexible-quantity-measurement-price-calculator-for-woocommerce')]);
?>
		</div>

		<div class="flex-row-item">
		<?php 
\woocommerce_wp_text_input(['id' => 'fq_dec_fixed_' . $dimension_slug . '_size', 'name' => 'fq[decimals][' . $dimension_slug . '][fixed][size]', 'value' => $settings->bag('fixed')->getString('size'), 'class' => 'fq_dec_fixed_' . $dimension_slug . '_size', 'wrapper_class' => 'myclass', 'label' => \esc_html__('Value', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'type' => 'number', 'custom_attributes' => ['step' => '0.01', 'min' => '0'], 'desc_tip' => \true, 'description' => \esc_html__('Select the products size.', 'flexible-quantity-measurement-price-calculator-for-woocommerce')]);
?>
		</div>
	</div>

	<div class="flex-row-container decimals-fields-with-labels user-fields">
		<div class="flex-row-item">
		<?php 
\woocommerce_wp_text_input(['id' => 'fq_dec_user_' . $dimension_slug . '_label', 'name' => 'fq[decimals][' . $dimension_slug . '][user][label]', 'value' => $settings->bag('user')->getString('label'), 'class' => 'fq_dec_user_' . $dimension_slug . '_label', 'wrapper_class' => 'myclass', 'label' => \esc_html__('Field label', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'placeholder' => \esc_html__('Field label', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'desc_tip' => \true, 'description' => \esc_html__('Enter the name for the dimension field label.', 'flexible-quantity-measurement-price-calculator-for-woocommerce')]);
?>
		</div>

		<div class="flex-row-item">
		<?php 
\woocommerce_wp_select(['id' => 'fq_dec_user_' . $dimension_slug . '_unit', 'name' => 'fq[decimals][' . $dimension_slug . '][user][unit]', 'class' => 'wqm-select fq_dec_user_' . $dimension_slug . '_unit', 'value' => $settings->bag('user')->getString('unit'), 'label' => \esc_html__('Unit of measure', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'options' => $units, 'desc_tip' => \true, 'description' => \esc_html__('Choose the unit of measure for the dimension.', 'flexible-quantity-measurement-price-calculator-for-woocommerce')]);
?>
		</div>

		<div class="flex-row-item">
			&nbsp;
		</div>

		<div class="flex-row-item">
		<?php 
\woocommerce_wp_text_input(['id' => 'fq_dec_user_' . $dimension_slug . '_increment', 'name' => 'fq[decimals][' . $dimension_slug . '][user][increment]', 'value' => $settings->bag('user')->getString('increment'), 'class' => 'fq_dec_user_' . $dimension_slug . '_increment', 'wrapper_class' => 'myclass', 'label' => \esc_html__('Increment', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'type' => 'number', 'custom_attributes' => ['step' => '0.01', 'min' => '0'], 'desc_tip' => \true, 'description' => \esc_html__('Fill in the increment value for the unit dimension.', 'flexible-quantity-measurement-price-calculator-for-woocommerce')]);
?>
		</div>

		<div class="flex-row-item">
		<?php 
\woocommerce_wp_text_input(['id' => 'fq_dec_user_' . $dimension_slug . '_min_quantity', 'name' => 'fq[decimals][' . $dimension_slug . '][user][min_quantity]', 'value' => $settings->bag('user')->getString('min_quantity'), 'class' => 'fq_dec_user_' . $dimension_slug . '_min_quantity', 'wrapper_class' => 'myclass', 'label' => \esc_html__('Minimum value', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'type' => 'number', 'custom_attributes' => ['step' => '0.01', 'min' => '0'], 'desc_tip' => \true, 'description' => \esc_html__('Set the minimum value for the unit dimension.', 'flexible-quantity-measurement-price-calculator-for-woocommerce')]);
?>
		</div>

		<div class="flex-row-item">
		<?php 
\woocommerce_wp_text_input(['id' => 'fq_dec_user_' . $dimension_slug . '_max_quantity', 'name' => 'fq[decimals][' . $dimension_slug . '][user][max_quantity]', 'value' => $settings->bag('user')->getString('max_quantity'), 'class' => 'fq_dec_user_' . $dimension_slug . '_max_quantity', 'wrapper_class' => 'myclass', 'label' => \esc_html__('Maximum value', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'type' => 'number', 'custom_attributes' => ['step' => '0.01', 'min' => '0'], 'desc_tip' => \true, 'description' => \esc_html__('Set the maximum value for the unit dimension.', 'flexible-quantity-measurement-price-calculator-for-woocommerce')]);
?>
		</div>
	</div>
</div>
<?php 
