<?php

namespace WDFQVendorFree;

/**
 * Template for displaying the marketing page.
 *
 * @var MarketingBoxes $boxes
 */
$boxes = $params['boxes'] ?? \false;
if (!$boxes) {
    return;
}
?>
<div class="wrap">
	<div id="marketing-page-wrapper">
		<?php 
echo $boxes->get_boxes()->get_all();
//phpcs:ignore 
?>

		<div class="marketing-buttons">
			<a class="button button-primary button-support" target="_blank" href="<?php 
echo \esc_url($is_locked ? $translate->__('url.support.free') : $translate->__('url.support.pro'));
?>">
				<?php 
\esc_html_e('Get support', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?>
			</a>
			<a class="button button-primary button-idea" target="_blank" href="<?php 
echo \esc_url($translate->__('url.feature-request'));
?>">
				<?php 
\esc_html_e('Share idea', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?>
			</a>
		</div>

		<div class="wpdesk-tooltip-shadow"></div>
		<div id="confirm-support" class="wpdesk-tooltip wpdesk-tooltip-confirm">
			<span class="close-modal close-modal-button"><span class="dashicons dashicons-no-alt"></span></span>
			<h3><?php 
\esc_html_e('Before sending a message please:', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?></strong></h3>
			<ul>
				<li><?php 
\esc_html_e('Prepare the information about the version of WordPress, WooCommerce, and Flexible Quantity (preferably your system status from WooCommerce->Status)', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?></li>
				<li><?php 
\esc_html_e('Describe the issue you have', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?></li>
				<li><?php 
\esc_html_e('Attach any log files & printscreens of the issue', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?></li>
			</ul>
		</div>
	</div>
</div>
<?php 
