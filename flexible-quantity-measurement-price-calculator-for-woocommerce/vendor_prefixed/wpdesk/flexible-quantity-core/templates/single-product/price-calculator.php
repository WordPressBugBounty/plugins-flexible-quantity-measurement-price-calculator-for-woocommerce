<?php

namespace WDFQVendorFree;

/**
 * Template for price calculator.
 *
 * @var Product $product
 * @var string $total_amount_text
 * @var Measurement $product_measurement
 * @var Settings $settings
 * @var array <int, Measurement> $measurements
 * @var ProductPage $controller
 */
?>
<table id="price_calculator" class="wc-measurement-price-calculator-price-table user-defined-mode <?php 
echo \esc_html($product->get_type() . '_price_calculator');
?>">
	<?php 
foreach ($measurements as $measurement) {
    $controller->render_single_measurement_field($measurement, $settings);
}
?>

	<?php 
if ($settings->is_calculator_type_derived()) {
    ?>

		<tr class="price-table-row total-amount">
			<td>
				<?php 
    echo \wp_kses_post($total_amount_text);
    ?>
			</td>
			<td style="text-align:right;">
				<span
					class="wc-measurement-price-calculator-total-amount"
					data-unit="<?php 
    echo \esc_attr($product_measurement->get_unit());
    ?>"></span>
			</td>
		</tr>

	<?php 
}
?>

	<tr class="price-table-row calculated-price">

		<td><?php 
echo \esc_html(\__('Product Price', 'flexible-quantity-measurement-price-calculator-for-woocommerce'));
?></td>

		<td style="text-align:right;">

			<span class="product_price"></span>
			<input
				type="hidden"
				id="_measurement_needed"
				name="_measurement_needed"
				value=""
			/>
			<input
				type="hidden"
				id="_measurement_needed_unit"
				name="_measurement_needed_unit"
				value=""
			/>

			<?php 
if ($product->is_sold_individually()) {
    ?>

				<input
					type="hidden"
					name="quantity"
					value="1"
				/>

			<?php 
}
?>

		</td>

	</tr>

</table>
<?php 
