<?php

namespace WDFQVendorFree;

/**
 * Template for displaying a shipping table row
 *
 * @var string $from
 * @var string $to
 * @var string $shipping_class
 * @var string $measurement_step
 */
?>
<tr>
	<td>
		<?php 
\woocommerce_wp_text_input(['id' => '', 'name' => 'fq[shipping_table][items][from][]', 'class' => 'fq_shipping_table_from', 'value' => $from, 'wrapper_class' => 'myclass', 'label' => \false, 'placeholder' => '', 'type' => 'number', 'custom_attributes' => ['step' => $measurement_step, 'min' => '0']]);
?>
	</td>
	<td>
		<?php 
\woocommerce_wp_text_input(['id' => '', 'name' => 'fq[shipping_table][items][to][]', 'value' => $to, 'class' => 'fq_shipping_table_to', 'label' => \false, 'placeholder' => '', 'type' => 'number', 'custom_attributes' => ['step' => $measurement_step, 'min' => '0']]);
?>
	</td>
	<td>
		<p class="form-field _field">
		<?php 
$args = [
    'taxonomy' => 'product_shipping_class',
    'hide_empty' => 0,
    'show_option_none' => \__('No shipping class', 'woocommerce'),
    // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch
    'name' => 'fq[shipping_table][items][shipping_class][]',
    'id' => '',
    'selected' => $shipping_class,
    'class' => 'select short',
    'orderby' => 'name',
];
\wp_dropdown_categories($args);
?>
		</p>
	</td>
	<td class="actions">
		<a class="insert" href="#"><span class="dashicons dashicons-insert"></span></a>
		<a class="remove" href="#"><span class="dashicons dashicons-remove"></span></a>
	</td>
</tr>
<?php 
