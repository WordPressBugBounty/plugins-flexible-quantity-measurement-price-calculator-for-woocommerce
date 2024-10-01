<?php

namespace WDFQVendorFree;

/**
 * Template for custom units page.
 *
 * @var bool $is_save
 * @var string $nonce_action
 * @var string $nonce_name
 * @var bool $is_locked
 * @var Renderer $renderer
 * @var Translate $translate
 */
?>

<form action="" method="post">
	<?php 
\wp_nonce_field($nonce_action, $nonce_name);
?>

	<?php 
if ($is_save && !$is_locked) {
    ?>
		<div id="message" class="updated fade">
			<p><strong><?php 
    \esc_html_e('Settings saved', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
    ?></strong></p>
		</div>
	<?php 
}
?>

	<h3><?php 
\esc_html_e('Flexible Quantity - Custom Units', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?></h3>

	<div class="<?php 
echo $is_locked ? 'semi-transparent' : '';
?>">
		<p><?php 
\esc_html_e('Below you can add custom units, which will be added to the list of units.', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?></p>
		<p class="bold">
			<?php 
\printf(
    /* translators: %1$s and %2$s: anchor opening and closing tags with right arrow */
    \esc_html__('Read more in the %1$splugin documentation%2$s', 'flexible-quantity-measurement-price-calculator-for-woocommerce'),
    '<a href="' . \esc_url($translate->__('url.docs.custom_units')) . '" target="_blank" class="link-docs">',
    ' →</a>'
);
?>
		</p>
	</div>
	<p class="bold">
	<?php 
if ($is_locked) {
    \printf(
        /* translators: %1$s and %2$s: anchor opening and closing tags with right arrow */
        \esc_html__('This feature is available in the PRO version. %1$sUpgrade to PRO%2$s', 'flexible-quantity-measurement-price-calculator-for-woocommerce'),
        '<a href="' . \esc_url($translate->__('url.pro.custom_units')) . '" target="_blank" class="link-pro">',
        ' →</a>'
    );
}
?>
	</p>

	<div id="fq-custom-units-wrapper">
		<div id="fq-custom-units" class="flex-container odd <?php 
echo $is_locked ? 'semi-transparent' : '';
?>">

			<?php 
foreach ($units as $key => $unit) {
    $renderer->output_render('settings/custom-units/custom-units-row', ['field_name' => $unit['name'] ?? '', 'disabled' => $key === 0 ? \true : \false, 'is_locked' => $is_locked]);
}
?>

		</div>
		<p class="submit">
			<input type="submit" value="<?php 
\esc_attr_e('Save settings', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?>" class="button button-primary" id="submit" name="submitForm">
		</p>
	</div>
</form>
<?php 
