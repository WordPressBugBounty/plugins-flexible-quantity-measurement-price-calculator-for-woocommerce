<?php

namespace WDFQVendorFree;

/**
 * Template for price settings panel on product page.
 *
 * @var string $template_url
 * @var string $pro_url
 * @var bool $is_locked
 */
?>

<p class="form-field js-disabled-price-info">
	<label style="visibility:hidden;">&nbsp;</label>
	<strong><?php 
\esc_html_e('Note:', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?></strong>
	<?php 
if ($is_locked) {
    ?>
		<?php 
    \esc_html_e('This product is assigned to the unit calculator template. To use the product prices as the unit prices,', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
    ?>
		<a class="link-pro" target="_blank" href="<?php 
    echo \esc_url($pro_url);
    ?>">
			<b><?php 
    \esc_html_e('upgrade to PRO →', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
    ?></b>
		</a>
	<?php 
} else {
    ?>
		<?php 
    \esc_html_e('This product is assigned to the unit calculator template. To use the product prices, enable the "Select to use product prices" option in the ', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
    ?>
		<a target="_blank" href="<?php 
    echo \esc_url($template_url);
    ?>">
			<?php 
    \esc_html_e('template settings', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
    ?>
		</a>.
	<?php 
}
?>
</p>
<?php 
