<?php

namespace WDFQVendorFree;

/**
 * Template for single measurement field.
 *
 * @var Measurement $measurement
 * @var string $measurement_name
 * @var string $measurement_value
 * @var array $attributes
 * @var string $help_text
 */
?>
<tr class="price-table-row <?php 
echo \esc_html($measurement->get_name());
?>-input">
	<td>
		<label for="<?php 
echo \esc_attr($measurement_name);
?>">
		<?php 
if ($measurement->get_unit_label()) {
    echo \wp_kses_post(\sprintf('%1$s (%2$s)', $measurement->get_label(), \__($measurement->get_unit_label(), 'flexible-quantity-measurement-price-calculator-for-woocommerce')));
} else {
    echo \wp_kses_post($measurement->get_label());
}
?>
		</label>
	</td>

	<td style="text-align:right;">

		<?php 
if ('' !== $help_text) {
    ?>
			<span class="dashicons dashicons-editor-help wc-measurement-price-calculator-input-help tip" title="<?php 
    echo \esc_html($help_text);
    ?>"></span>
		<?php 
}
?>

		<input
			<?php 
echo $measurement->is_editable() ? '' : 'readonly';
?>
			type="number"
			name="<?php 
echo \esc_attr($measurement_name);
?>"
			id="<?php 
echo \esc_attr($measurement_name);
?>"
			class="amount_needed"
			value="<?php 
echo \esc_attr($measurement_value);
?>"
			data-unit="<?php 
echo \esc_attr($measurement->get_unit());
?>"
			data-common-unit="<?php 
echo \esc_attr($measurement->get_unit_common());
?>"
			autocomplete="off"
			<?php 
echo \implode(' ', $attributes);
// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
?>
		/>

	</td>
</tr>
<?php 
