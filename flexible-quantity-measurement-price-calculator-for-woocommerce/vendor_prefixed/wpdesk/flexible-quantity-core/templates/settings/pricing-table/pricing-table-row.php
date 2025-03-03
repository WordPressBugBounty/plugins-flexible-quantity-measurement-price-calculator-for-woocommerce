<?php

namespace WDFQVendorFree;

/**
 * Template for displaying a pricing table row
 *
 * @var string $from
 * @var string $to
 * @var string $price
 * @var string $sale_price
 * @var string $measurement_step
 */
?>
<tr>
	<td>
		<?php 
\woocommerce_wp_text_input(['id' => '', 'name' => 'fq[pricing_table][items][from][]', 'class' => 'fq_pricing_table_from', 'value' => $from, 'wrapper_class' => 'myclass', 'label' => \false, 'placeholder' => '', 'type' => 'number', 'custom_attributes' => ['step' => $measurement_step, 'min' => '0']]);
?>
	</td>
	<td>
		<?php 
\woocommerce_wp_text_input(['id' => '', 'name' => 'fq[pricing_table][items][to][]', 'value' => $to, 'class' => 'fq_pricing_table_to', 'label' => \false, 'placeholder' => '', 'type' => 'number', 'custom_attributes' => ['step' => $measurement_step, 'min' => '0']]);
?>
	</td>
	<td>
		<?php 
\woocommerce_wp_text_input(['id' => '', 'name' => 'fq[pricing_table][items][price][]', 'value' => $price, 'class' => 'fq_pricing_table_price', 'label' => \false, 'placeholder' => '', 'type' => 'number', 'custom_attributes' => ['step' => '0.01', 'min' => '0']]);
?>
	</td>
	<td>
		<?php 
\woocommerce_wp_text_input(['id' => '', 'name' => 'fq[pricing_table][items][sale_price][]', 'value' => $sale_price, 'class' => 'fq_pricing_table_sale_price', 'label' => \false, 'placeholder' => '', 'type' => 'number', 'custom_attributes' => ['step' => '0.01', 'min' => '0']]);
?>
	</td>
	<td class="actions">
		<a class="insert" href="#"><span class="dashicons dashicons-insert"></span></a>
		<a class="remove" href="#"><span class="dashicons dashicons-remove"></span></a>
	</td>
</tr>
<?php 
