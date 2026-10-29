<?php

namespace WDFQVendorFree;

use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Collections\SettingsBag;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Units;
use WDFQVendorFree\WPDesk\Translation\Translate;
/**
 * Template for common settings
 *
 * @var SettingsBag<string,mixed> $settings
 * @var array $available_units
 * @var string $current_currency
 * @var bool $is_locked
 * @var string $measurement_step
 * @var Translate $translate
 */
?>
<div class="fcm-panel-item-body fcm-body-decimal">
	<div class="fq-field-type">
		<div class="flex-row-container decimals-fields-with-labels">
			<div class="flex-row-item">
				<?php 
\woocommerce_wp_text_input(['id' => 'fq_label', 'name' => 'fq[label]', 'value' => $settings->getString('label'), 'placeholder' => '', 'class' => 'wqm-select fq_label', 'label' => \esc_html__('Unit Field Label', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'desc_tip' => \true, 'description' => \esc_html__('Set the field label to be visible on the product page.', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'type' => 'text']);
?>
			</div>

			<div class="flex-row-item">
				<?php 
echo Units::unit_select(
    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- all needed escaping is done inside the function.
    [
        'id' => 'fq_unit',
        'name' => 'fq[unit]',
        'value' => \esc_attr($settings->getString('unit')),
        'placeholder' => '',
        'class' => 'wqm-select fq_unit',
        'label' => \esc_html__('Unit of measure', 'flexible-quantity-measurement-price-calculator-for-woocommerce'),
        'options' => $available_units,
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        'desc_tip' => \true,
        'description' => \esc_html__('Select the products unit whose quantity you are selling.', 'flexible-quantity-measurement-price-calculator-for-woocommerce'),
    ]
);
?>
			</div>
			<div class="flex-row-item"></div>
		</div>
	</div>
	<div class="fq-field-type">
		<div class="flex-row-container decimals-fields-with-labels">
			<div class="flex-row-item">
				<p class="form-field">
					<?php 
$price_source_value = $settings->getString('default_price_enabled');
$price_source_value = $is_locked ? 'no' : $price_source_value;
?>
					<label for="fq_price_source"><?php 
\esc_html_e('Price source', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?></label>
					<select class="fq_price_source select short" name="fq[default_price_enabled]" id="fq_price_source">
						<option value="no" <?php 
\selected($price_source_value, 'no');
?>><?php 
\esc_html_e('Flexible Quantity', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?></option>
						<option value="yes" <?php 
\selected($price_source_value, 'yes');
?> <?php 
\disabled($is_locked);
?>>
							<?php 
echo $is_locked ? \esc_html__('Product (PRO version only)', 'flexible-quantity-measurement-price-calculator-for-woocommerce') : \esc_html__('Product', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?>
						</option>
					</select>
				</p>
			</div>
			<div class="flex-row-item" data-price-dependent>
				<?php 
\woocommerce_wp_text_input(['id' => 'fq_price', 'name' => 'fq[price]', 'value' => $settings->getString('price'), 'placeholder' => '', 'class' => 'fq_price', 'label' => \sprintf(
    /* translators: Placeholders: %s - currency symbol */
    \esc_html__('Price (%s)', 'flexible-quantity-measurement-price-calculator-for-woocommerce'),
    $current_currency
), 'desc_tip' => \true, 'description' => \esc_html__('Set product base price.', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'type' => 'number', 'custom_attributes' => ['step' => '0.01', 'min' => '0']]);
?>
			</div>
			<div class="flex-row-item" data-price-dependent>
				<?php 
\woocommerce_wp_text_input(['id' => 'fq_sale_price', 'name' => 'fq[sale_price]', 'value' => $settings->getString('sale_price'), 'placeholder' => '', 'class' => 'fq_sale_price', 'label' => \sprintf(
    /* translators: %s: current currency symbol. */
    \esc_html__('Sale price (%s)', 'flexible-quantity-measurement-price-calculator-for-woocommerce'),
    $current_currency
), 'desc_tip' => \true, 'description' => \esc_html__('Set the sale price for the unit of measure.', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'type' => 'number', 'custom_attributes' => ['step' => '0.01', 'min' => '0']]);
?>
			</div>
		</div>

		<div class="flex-row-container decimals-fields-with-labels">

			<div class="flex-row-item">
				<?php 
\woocommerce_wp_text_input(['id' => 'fq_increment', 'name' => 'fq[increment]', 'value' => $settings->getString('increment'), 'placeholder' => '', 'class' => 'wqm-select fq_increment', 'label' => \esc_html__('Increment', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'desc_tip' => \true, 'description' => \esc_html__('Set the increment value for the quantity at which the price will increase.', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'type' => 'number', 'custom_attributes' => ['step' => $measurement_step, 'min' => '0']]);
?>
			</div>

			<div class="flex-row-item">
				<?php 
\woocommerce_wp_text_input(['id' => 'fq_min_range', 'name' => 'fq[min_range]', 'value' => $settings->getString('min_range'), 'placeholder' => '', 'class' => 'fq_min_range', 'label' => \esc_html__('Minimum quantity', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'desc_tip' => \true, 'description' => \esc_html__('Set the minimum quantity range.', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'type' => 'number', 'custom_attributes' => ['step' => $measurement_step, 'min' => '0']]);
?>
			</div>

			<div class="flex-row-item">
				<?php 
\woocommerce_wp_text_input(['id' => 'fq_max_range', 'name' => 'fq[max_range]', 'value' => $settings->getString('max_range'), 'placeholder' => '', 'class' => 'fq_max_range', 'label' => \esc_html__('Maximum quantity', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'desc_tip' => \true, 'description' => \esc_html__('Set the maximum quantity range.', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'type' => 'number', 'custom_attributes' => ['step' => $measurement_step, 'min' => '0']]);
?>
			</div>
			<div class="flex-row-item">&nbsp;</div>
		</div>

		<h2><?php 
\esc_html_e('Advanced settings', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?></h2>
		<div class="flex-row-container decimals-fields-with-labels">
			<div class="flex-row-item">
				<?php 
$calculate_inventory_is_yes = $settings->getString('calculate_inventory') === 'yes';
?>
				<fieldset class="form-field fq_calculate_inventory_field">
					<legend><?php 
\esc_html_e('Impact on stock management', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?></legend>
					<ul class="wc-radios">
						<li>
							<label>
								<input type="radio" name="fq[calculate_inventory]" value="" <?php 
\checked(!$calculate_inventory_is_yes);
?> /><?php 
\esc_html_e('Always decrease by 1', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?>
							</label>
							<span class="description"><?php 
\esc_html_e('Example: Ordering 10 kg of product will reduce stock by 1.', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?></span>
						</li>
						<li>
							<label>
								<input type="radio" name="fq[calculate_inventory]" value="yes" <?php 
\checked($calculate_inventory_is_yes);
?> /><?php 
\esc_html_e('Decrease by an amount equal to the units purchased', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?>
							</label>
							<span class="description"><?php 
\esc_html_e('Example: Ordering 10 kg of product will reduce stock by 10.', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?></span>
						</li>
					</ul>
				</fieldset>
			</div>
		</div>

		<div class="flex-row-container decimals-fields-with-labels">
			<div class="flex-row-item">
				<?php 
$sold_individually_is_yes = $settings->getString('sold_individually') === 'yes';
?>
				<fieldset class="form-field fq_sold_individually_field">
					<legend><?php 
\esc_html_e('Purchasing a specific product configuration', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?></legend>
					<ul class="wc-radios">
						<li>
							<label>
								<input type="radio" name="fq[sold_individually]" value="" <?php 
\checked(!$sold_individually_is_yes);
?> /><?php 
\esc_html_e('Unlimited', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?>
							</label>
							<span class="description"><?php 
\esc_html_e('Example: You can add 10 kg of a product to your cart. You can then re-add the same configured product.', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?></span>
						</li>
						<li>
							<label>
								<input type="radio" name="fq[sold_individually]" value="yes" <?php 
\checked($sold_individually_is_yes);
?> /><?php 
\esc_html_e('One-time', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?>
							</label>
							<span class="description"><?php 
\esc_html_e('Example: You can add 10 kg of product to your cart once. You must change the unit value to something other than 10 kg to be able to add the product to your cart again.', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?></span>
						</li>
					</ul>
				</fieldset>
			</div>
		</div>
	</div>
</div>
<?php 
