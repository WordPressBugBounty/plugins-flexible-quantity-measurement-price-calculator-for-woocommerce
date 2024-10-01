<?php

namespace WDFQVendorFree;

/**
 * Template for settings panel on product page.
 */
?>
<div id="measurement_product_data" class="panel woocommerce_options_panel" >
	<div class="measurement-header" style="padding: 10px;">
		<h3><?php 
\esc_html_e('Flexible Quantity - Measurement Calculator', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?></h3>
		<p class="measurement-header-descr">
			<?php 
\printf(
    /* translators: %1$s: link to plugin settings page, %2$s: closing link tag. */
    \esc_html__('The Flexible Quantity plugin settings you are looking for can be found %1$shere →%2$s', 'flexible-quantity-measurement-price-calculator-for-woocommerce'),
    '<a href="' . \esc_url($template_url) . '">',
    '</a>'
);
?>
		</p>
	</div>
</div>
<?php 
