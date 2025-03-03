<?php

namespace WDFQVendorFree;

/**
 * Templates for settings
 *
 * @var bool $is_locked
 * @var string $current_currency
 * @var SettingsBag $settings
 * @var Translate $translate
 * @var Renderer $renderer
 * @var string $measurement_step
 */
?>
<div class="measurement-header">
	<h4><?php 
\esc_html_e('Pricing table', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?></h4>
	<?php 
if ($is_locked) {
    ?>
		<p class="bold form-field-desc">
		<?php 
    \printf(
        /* translators: %1$s and %2$s: anchor opening and closing tags with right arrow */
        \esc_html__('This feature is available in the PRO version. %1$sUpgrade to PRO%2$s', 'flexible-quantity-measurement-price-calculator-for-woocommerce'),
        '<a href="' . \esc_url($translate->__('url.pro.template.pricing_table')) . '" target="_blank" class="link-pro">',
        ' →</a>'
    );
    ?>
		</p>
	<?php 
}
?>

	<?php 
\woocommerce_wp_checkbox(['id' => 'fq_pricing_table_enable', 'name' => 'fq[pricing_table][enable]', 'value' => $is_locked ? 'no' : $settings->getString('enable'), 'class' => 'checkbox fq_pricing_table_enable show_table_pricing', 'label' => \false, 'description' => \wp_kses_post(\__('Enable Pricing Table', 'flexible-quantity-measurement-price-calculator-for-woocommerce')), 'custom_attributes' => $is_locked ? ['disabled' => 'disabled'] : []]);
?>
	<p class="form-field-desc js-price-table-info"><?php 
\esc_html_e('The price table cannot be enabled while the "Select to use product prices" option is enabled.', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?></p>
	<p class="form-field-desc <?php 
echo $is_locked ? 'semi-transparent' : '';
?>">
		<?php 
\esc_html_e('The table will allow you to determine the different prices of the unit of measurement based on its quantity. Set the quantity range, and the regular and the sale price. The plugin will apply the first met condition from the table.', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?>
		<br />
		<span class="bold">
			<?php 
\printf(
    /* translators: %1$s and %2$s: anchor opening and closing tags with right arrow */
    \esc_html__('Read more in the %1$splugin documentation%2$s', 'flexible-quantity-measurement-price-calculator-for-woocommerce'),
    '<a href=" ' . \esc_url($translate->__('url.docs.template.pricing_table')) . ' " target="_blank" class="link-docs">',
    ' →</a>'
);
?>
		</span>
	</p>
</div>

<div class="fcm-panel-item-body <?php 
echo $is_locked ? 'semi-transparent' : '';
?>">
	<table class="widefat fcm-pricing-table">
		<thead>
		<tr>
			<th><?php 
\esc_html_e('From', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
echo \wc_help_tip(\__('The minimum quantity to apply the new price for the unit of measure.', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), \true);
?></th>
			<th><?php 
\esc_html_e('To', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
echo \wc_help_tip(\__('The maximum quantity to apply the new price for the unit of measure.', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), \true);
?></th>
			<th><?php 
\esc_html_e('Price', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?> (<?php 
echo \esc_html($current_currency);
?>)<?php 
echo \wc_help_tip(\__('New regular price per unit.', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), \true);
?></th>
			<th><?php 
\esc_html_e('Sale Price', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?> (<?php 
echo \esc_html($current_currency);
?>)<?php 
echo \wc_help_tip(\__('New sale price per unit.', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), \true);
?></th>
			<th class="actions">&nbsp;</th>
		</tr>
		</thead>
		<tbody>

			<?php 
$items = $settings->bag('items');
$rows = $items->bag('from')->isEmpty() ? 1 : $items->bag('from')->count();
for ($i = 0; $i < $rows; $i++) {
    $renderer->output_render('settings/pricing-table/pricing-table-row', ['from' => $items->bag('from')->getString($i), 'to' => $items->bag('to')->getString($i), 'price' => $items->bag('price')->getString($i), 'sale_price' => $items->bag('sale_price')->getString($i), 'measurement_step' => $measurement_step]);
}
?>

		</tbody>
	</table>
</div>
<?php 
