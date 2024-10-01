<?php

namespace WDFQVendorFree;

/**
 * Template for template section in settings page.
 */
?>
<section id="measurement_product_data" class="template panel woocommerce_options_panel">
	<header class="measurement-header">
		<?php 
\esc_html_e('Fill in the increment and the price that will increase by reaching it.', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?></br>
		<?php 
\esc_html_e('For area units, you can use extended options that will allow you to calculate prices based on dimensions on the product page.', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?></br>
		<p class="bold">
		<?php 
\printf(
    /* translators: %1$s and %2$s: anchor opening and closing tags with right arrow */
    \esc_html__('Read more in the %1$splugin documentation%2$s', 'flexible-quantity-measurement-price-calculator-for-woocommerce'),
    '<a href=" ' . \esc_url($translate->__('url.docs.template.basic')) . ' " target="_blank" class="link-docs">',
    ' →</a>'
);
?>
		</p>
	</header>

	<!-- for backward compatibility -->
	<input type="hidden" name="fq[enable]" value="yes" />

	<div id="calculator-settings" class="product-panel-item fq-hidden-panels fcm-dimensions-decimals-panel">

		<?php 
$renderer->output_render('settings/basic-settings/basic-settings', ['settings' => $settings->bag('fq'), 'available_units' => $available_units, 'current_currency' => $current_currency]);
?>

	</div>

	<div class="product-panel-item fcm-dimensions-decimals-panel fq-hidden-panels dimensions">

		<?php 
$renderer->output_render('settings/dimensions/dimensions', ['settings' => $settings->bag('fq'), 'is_locked' => $is_locked, 'translate' => $translate]);
?>

	</div>

	<div class="product-panel-item fcm-pricing-panel fq-hidden-panels">

		<?php 
$renderer->output_render('settings/pricing-table/pricing-table', ['settings' => $settings->bag('fq')->bag('pricing_table'), 'is_locked' => $is_locked, 'translate' => $translate, 'renderer' => $renderer, 'current_currency' => $current_currency]);
?>

	</div>

	<div class="product-panel-item fcm-shipping-panel fq-hidden-panels">

		<?php 
$renderer->output_render('settings/shipping-table/shipping-table', ['settings' => $settings->bag('fq')->bag('shipping_table'), 'is_locked' => $is_locked, 'translate' => $translate, 'renderer' => $renderer]);
?>

	</div>

</section>
<?php 
