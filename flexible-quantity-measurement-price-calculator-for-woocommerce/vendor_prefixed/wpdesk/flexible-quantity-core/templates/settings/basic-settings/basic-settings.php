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
				<?php 
\woocommerce_wp_text_input(['id' => 'fq_price', 'name' => 'fq[price]', 'value' => $settings->getString('price'), 'placeholder' => '', 'class' => 'fq_price', 'label' => \sprintf(
    /* translators: Placeholders: %s - currency symbol */
    \esc_html__('Price (%s)', 'flexible-quantity-measurement-price-calculator-for-woocommerce'),
    $current_currency
), 'desc_tip' => \true, 'description' => \esc_html__('Set product base price.', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'type' => 'number', 'custom_attributes' => ['step' => '0.01', 'min' => '0']]);
?>
			</div>
			<div class="flex-row-item">
				<?php 
\woocommerce_wp_text_input(['id' => 'fq_sale_price', 'name' => 'fq[sale_price]', 'value' => $settings->getString('sale_price'), 'placeholder' => '', 'class' => 'fq_sale_price', 'label' => \sprintf(
    /* translators: %s: current currency symbol. */
    \esc_html__('Sale price (%s)', 'flexible-quantity-measurement-price-calculator-for-woocommerce'),
    $current_currency
), 'desc_tip' => \true, 'description' => \esc_html__('Set the sale price for the unit of measure.', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'type' => 'number', 'custom_attributes' => ['step' => '0.01', 'min' => '0']]);
?>
			</div>
			<div class="flex-row-item">
				<?php 
\woocommerce_wp_checkbox(['id' => 'fq_default_price_enabled', 'name' => 'fq[default_price_enabled]', 'value' => $is_locked ? 'no' : $settings->getString('default_price_enabled'), 'default' => '0', 'label' => '', 'class' => 'fq_default_price_enabled', 'description' => \__('Select to use product prices', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'custom_attributes' => $is_locked ? ['disabled' => 'disabled'] : []]);
?>
				<p class="bold" style="margin: 0">
					<?php 
if ($is_locked) {
    \printf(
        /* translators: %1$s and %2$s: anchor opening and closing tags with right arrow */
        \esc_html__('This feature is available in the PRO version. %1$sUpgrade to PRO%2$s', 'flexible-quantity-measurement-price-calculator-for-woocommerce'),
        '<a href="' . \esc_url($translate->__('url.pro.template.basic_settings')) . '" target="_blank" class="link-pro">',
        ' →</a>'
    );
}
?>
				</p>
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

		<div class="flex-row-container decimals-fields-with-labels">

			<div class="flex-row-item">
				<?php 
\woocommerce_wp_checkbox(['id' => 'fq_calculate_inventory', 'name' => 'fq[calculate_inventory]', 'value' => $settings->getString('calculate_inventory'), 'class' => 'fq_calcluate_inventory', 'label' => \esc_html__('Calculate Inventory', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'description' => \__('Check this box to define inventory per unit and calculate inventory based on the product. <br><br> If you select this option, then, e.g., 30 kg will be seen as 30 pcs. of the product. If you don\'t, then regardless of the purchased amount of the new unit of measurement, the stock will decrease by 1.', 'flexible-quantity-measurement-price-calculator-for-woocommerce')]);
?>
			</div>
		</div>

		<div class="flex-row-container decimals-fields-with-labels">
			<div class="flex-row-item">
				<?php 
\woocommerce_wp_checkbox(['id' => 'fq_sold_individually', 'name' => 'fq[sold_individually]', 'value' => $settings->getString('sold_individually'), 'class' => 'fq_sold_individually', 'label' => \esc_html__('Sold individually', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'description' => $is_locked ? \sprintf(
    /* translators: %1$s is double line break */
    \__('Enable this to only allow one of this item to be bought in a single order.%1$s With this option, the buyer will be able to order only 1 item of the product with the new unit of measure (e.g., 5 kg.). If you don’t select that option, it will be possible to buy more pcs. of the product (e.g., 5 kg. each).', 'flexible-quantity-measurement-price-calculator-for-woocommerce'),
    '<br><br>'
) : \sprintf(
    /* translators: %1$s is double line break, %2$s and %3$s is strong tag */
    \__('Enable this to only allow one of this item to be bought in a single order.%1$s With this option, the buyer will be able to order only 1 item of the product with the new unit of measure (e.g., 5 kg.). If you don’t select that option, it will be possible to buy more pcs. of the product (e.g., 5 kg. each).%2$s It supports simple products and variable products (parents only).%3$s', 'flexible-quantity-measurement-price-calculator-for-woocommerce'),
    '<br><br>',
    '<strong>',
    '</strong>'
)]);
?>
			</div>
		</div>
	</div>
</div>
<?php 
