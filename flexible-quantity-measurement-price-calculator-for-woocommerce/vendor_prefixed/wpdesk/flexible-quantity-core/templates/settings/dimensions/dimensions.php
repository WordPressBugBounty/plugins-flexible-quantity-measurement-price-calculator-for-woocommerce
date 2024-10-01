<?php

namespace WDFQVendorFree;

/**
 * Template for displaying unit dimensions settings
 *
 * @var bool $is_locked
 * @var SettingsBag $settings
 * @var Translate $translate
 */
?>
<div class="measurement-header">
	<h4><?php 
\esc_html_e('Unit Dimensions', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?></h4>
	<?php 
if ($is_locked) {
    ?>
		<p class="bold form-field-desc">
		<?php 
    \printf(
        /* translators: %1$s and %2$s: anchor opening and closing tags with right arrow */
        \esc_html__('This feature is available in the PRO version. %1$sUpgrade to PRO%2$s', 'flexible-quantity-measurement-price-calculator-for-woocommerce'),
        '<a href="' . \esc_url($translate->__('url.pro.template.dimensions')) . '" target="_blank" class="link-pro">',
        ' →</a>'
    );
    ?>
		</p>
	<?php 
}
?>

	<?php 
\woocommerce_wp_checkbox(['id' => 'fq_decimals_enabled', 'name' => 'fq[decimals_enabled]', 'value' => $is_locked ? 'no' : $settings->getString('decimals_enabled'), 'class' => 'fq_decimals_enabled', 'label' => \false, 'description' => \wp_kses_post(\__('Enable Advanced Calculator Settings.', 'flexible-quantity-measurement-price-calculator-for-woocommerce')), 'custom_attributes' => $is_locked ? ['disabled' => 'disabled'] : []]);
?>
	<p class="form-field-desc <?php 
echo $is_locked ? 'semi-transparent' : '';
?>">
		<?php 
\esc_html_e('Use one of the two options available for each dimension. Set a fixed value for the dimension, or enable value filling on the product page.', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?>
		<br />
		<span class="bold">
			<?php 
\printf(
    /* translators: %1$s and %2$s: anchor opening and closing tags with right arrow */
    \esc_html__('Read more in the %1$splugin documentation%2$s', 'flexible-quantity-measurement-price-calculator-for-woocommerce'),
    '<a href=" ' . \esc_url($translate->__('url.docs.template.dimensions')) . ' " target="_blank" class="link-docs">',
    ' →</a>'
);
?>
		</span>
	</p>

</div>

<!-- This part is loaded dynamically (ajax) -->
<div id="fq-decimals-panel" class="fcm-panel-item-body fcm-body-decimal <?php 
echo $is_locked ? 'semi-transparent' : '';
?>"></div>
<?php 
