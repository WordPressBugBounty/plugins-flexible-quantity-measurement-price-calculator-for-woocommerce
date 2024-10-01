<?php

namespace WDFQVendorFree;

/**
 * Template for custom units row.
 *
 * @var string $field_name
 * @var bool $disabled
 */
?>
<div class="wrap-condition single-condition flex-row">
	<div class="flex-col width-100">
		<div class="flex-container">
			<div class="flex-row stretch flex-fields">
				<input type="text" name="custom_units[name][]" class="width-100" placeholder="<?php 
\esc_html_e('Product unit name', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?>" value="<?php 
echo \esc_attr($field_name);
?>">
			</div>
		</div>
	</div>
	<div class="flex-col">
		<span class="woocommerce-help-tip dashicons" data-tip="<?php 
\esc_attr_e('The name of the unit will be visible in the list in the product edition, in the Flexible Quantity tab', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?>"></span>
	</div>
	<div class="flex-col">
		<a href="#" class="insert add-condition <?php 
echo $is_locked === \true ? 'disabled' : '';
?>">
			<span class="dashicons dashicons-insert"></span>
		</a>
	</div>
	<div class="flex-col">
		<a href="#" class="remove remove-condition <?php 
echo $disabled === \true ? 'disabled' : '';
?>">
			<span class="dashicons dashicons-remove"></span>
		</a>
	</div>
</div>
<?php 
