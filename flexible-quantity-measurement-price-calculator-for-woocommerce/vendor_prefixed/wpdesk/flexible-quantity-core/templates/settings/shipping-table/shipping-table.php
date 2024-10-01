<?php

namespace WDFQVendorFree;

/**
 * Templates for settings
 *
 * @var bool $is_locked
 * @var SettingsBag $settings
 * @var Translate $translate
 * @var Renderer $renderer
 */
?>
<div class="measurement-header">
	<h4><?php 
\esc_html_e('Shipping class table', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?></h4>
	<?php 
if ($is_locked) {
    ?>
		<p class="bold form-field-desc">
		<?php 
    \printf(
        /* translators: %1$s and %2$s: anchor opening and closing tags with right arrow */
        \esc_html__('This feature is available in the PRO version. %1$sUpgrade to PRO%2$s', 'flexible-quantity-measurement-price-calculator-for-woocommerce'),
        '<a href="' . \esc_url($translate->__('url.pro.template.shipping_table')) . '" target="_blank" class="link-pro">',
        ' →</a>'
    );
    ?>
		</p>
	<?php 
}
?>

	<?php 
\woocommerce_wp_checkbox(['id' => 'fq_shipping_table_enable', 'name' => 'fq[shipping_table][enable]', 'value' => $is_locked ? 'no' : $settings->getString('enable'), 'class' => 'checkbox show_table_shipping', 'label' => \false, 'description' => \__('Enable Shipping Class Table', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'custom_attributes' => $is_locked ? ['disabled' => 'disabled'] : []]);
?>
	<p class="form-field-desc <?php 
echo $is_locked ? 'semi-transparent' : '';
?>">
		<?php 
\esc_html_e('The table will allow you to change the shipping class based on the quantity of the new unit of measure added to the cart. The plugin will apply the first condition that is met. The table uses WooCommerce shipping classes.', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?>
		<br />
		<span class="bold">
			<?php 
\printf(
    /* translators: %1$s and %2$s: anchor opening and closing tags with right arrow */
    \esc_html__('Read more in the %1$splugin documentation%2$s', 'flexible-quantity-measurement-price-calculator-for-woocommerce'),
    '<a href=" ' . \esc_url($translate->__('url.docs.template.shipping_table')) . ' " target="_blank" class="link-docs">',
    ' →</a>'
);
?>
		</span>
	</p>

</div>

<div class="fcm-panel-item-body <?php 
echo $is_locked ? 'semi-transparent' : '';
?>">
	<table class="widefat fcm-shipping-table">
		<thead>
			<tr>
				<th><?php 
\esc_html_e('From', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
echo \wc_help_tip(\__('The minimum quantity for applying to the new shipping class.', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), \true);
?></th>
				<th><?php 
\esc_html_e('To', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
echo \wc_help_tip(\__('The maximum quantity for applying to the new shipping class.', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), \true);
?></th>
				<th><?php 
\esc_html_e('Shipping class', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
echo \wc_help_tip(\__('New shipping class.', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), \true);
?></th>
				<th class="actions">&nbsp;</th>
			</tr>
		</thead>
		<tbody>

		<?php 
$items = $settings->bag('items');
$rows = $items->bag('from')->isEmpty() ? 1 : $items->bag('from')->count();
for ($i = 0; $i < $rows; $i++) {
    $renderer->output_render('settings/shipping-table/shipping-table-row', ['from' => $items->bag('from')->getString($i), 'to' => $items->bag('to')->getString($i), 'shipping_class' => $items->bag('shipping_class')->getString($i)]);
}
?>

		</tbody>
	</table>
</div>
<?php 
