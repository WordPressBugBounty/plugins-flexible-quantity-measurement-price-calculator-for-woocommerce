<?php

namespace WDFQVendorFree;

global $post;
use WDFQVendorFree\WPDesk\View\Renderer\Renderer;
use WDFQVendorFree\WPDesk\Library\WPCoupons\Helpers\Links;
use WDFQVendorFree\WPDesk\Library\WPCoupons\Helpers\Plugin;
$params = isset($params) ? (array) $params : [];
/**
 * @var \WPDesk\Library\WPCoupons\Integration\PostMeta $post_meta
 */
$post_meta = $params['post_meta'];
/**
 * @var Renderer $renderer
 */
$renderer = $params['renderer'];
$nonce_name = $params['nonce_name'];
$nonce_action = $params['nonce_action'];
$product_fields = $params['product_fields'];
$is_premium = $params['is_premium'];
$product_templates = $params['product_templates'];
$custom_attributes = $params['custom_attributes'];
$prod_post_id = (int) $params['post_id'];
$settings = $params['settings'];
$pro_url = Links::get_pro_link();
?>

<div id="pdfcoupon_product_data" class="panel woocommerce_options_panel" style="display: none;">
	<div class="fc-options-group">
		<?php 
\wp_nonce_field($nonce_action, $nonce_name);
$renderer->output_render('fields/product-template', ['post_meta' => $post_meta, 'post_id' => $prod_post_id, 'is_premium' => $is_premium, 'product_templates' => $product_templates]);
?>
	</div>
	<div class="fc-options-group fc-custom-fields-group">
		<?php 
if (!$is_premium) {
    echo '<p class="form-field marketing-content">';
    \printf(
        /* translators: %1$s: anchor opening tag, %2$s: anchor closing tag */
        \esc_html__('%1$sUpgrade to PRO →%2$s and enable options below', 'flexible-quantity-measurement-price-calculator-for-woocommerce'),
        \sprintf('<a href="%s" target="_blank" class="pro-link">', \esc_url($pro_url) . '&utm_content=edit-product'),
        '</a>'
    );
    echo '</p>';
}
$renderer->output_render('fields/coupon-code-enable', ['post_meta' => $post_meta, 'post_id' => $prod_post_id, 'is_premium' => $is_premium, 'custom_attributes' => $custom_attributes, 'settings' => $settings]);
?>
		<div class="fc-options-group fc-custom-fields-group fc-multiple-pdfs-options-wrapper">
		<?php 
$is_multiple_pdfs = Plugin::is_fc_multiple_pdfs_pro_addon_enabled();
if (!$is_multiple_pdfs) {
    echo '<p class="form-field marketing-content">';
    \printf(
        /* translators: %1$s: anchor opening tag, %2$s: anchor closing tag */
        \esc_html__('Buy %1$sFlexible PDF Coupons PRO - Multiple PDFs →%2$s and enable options below', 'flexible-quantity-measurement-price-calculator-for-woocommerce'),
        \sprintf('<a href="%s" target="_blank" class="sending-link">', \esc_url(Links::get_fcs_link()) . '&utm_content=&utm_content=edit-product'),
        '</a>'
    );
    echo '</p>';
}
$renderer->output_render('fields/multiple-pdfs/multiple-coupons-enable', ['post_meta' => $post_meta, 'post_id' => $prod_post_id, 'is_premium' => $is_premium, 'is_multiple_pdfs' => $is_multiple_pdfs, 'custom_attributes' => $custom_attributes, 'settings' => $settings]);
?>
			<div class="fc-options-group fc-custom-fields-group fc-multiple-pdfs-advanced-options">
				<?php 
$renderer->output_render('fields/multiple-pdfs/multiple-coupons-send-to-first-email', ['post_meta' => $post_meta, 'post_id' => $prod_post_id, 'is_premium' => $is_premium, 'is_multiple_pdfs' => $is_multiple_pdfs, 'custom_attributes' => $custom_attributes, 'settings' => $settings]);
$renderer->output_render('fields/multiple-pdfs/multiple-coupons-forms-limit', ['post_meta' => $post_meta, 'post_id' => $prod_post_id, 'is_premium' => $is_premium, 'is_multiple_pdfs' => $is_multiple_pdfs, 'custom_attributes' => $custom_attributes, 'settings' => $settings]);
?>
			</div>
		</div>
		<div class="show_if_variation_manage_prefix">
			<?php 
$renderer->output_render('fields/coupon-code-prefix', ['post_meta' => $post_meta, 'post_id' => $prod_post_id, 'is_premium' => $is_premium, 'custom_attributes' => $custom_attributes, 'settings' => $settings]);
$renderer->output_render('fields/coupon-code-suffix', ['post_meta' => $post_meta, 'post_id' => $prod_post_id, 'is_premium' => $is_premium, 'custom_attributes' => $custom_attributes, 'settings' => $settings]);
$renderer->output_render('fields/coupon-code-length', ['post_meta' => $post_meta, 'post_id' => $prod_post_id, 'is_premium' => $is_premium, 'custom_attributes' => $custom_attributes, 'settings' => $settings]);
?>
		</div>
		<?php 
$renderer->output_render('fields/product-fields', ['post_meta' => $post_meta, 'post_id' => $prod_post_id, 'is_premium' => $is_premium, 'product_fields' => $product_fields, 'custom_attributes' => $custom_attributes]);
?>
	</div>
	<div class="fc-options-group">
		<?php 
$renderer->output_render('fields/usage-limit', ['post_meta' => $post_meta, 'post_id' => $prod_post_id, 'is_premium' => $is_premium, 'custom_attributes' => $custom_attributes]);
$is_sending = Plugin::is_fcs_pro_addon_enabled();
if (!$is_sending) {
    echo '<p class="form-field marketing-content">';
    \printf(
        /* translators: %1$s: anchor opening tag, %2$s: anchor closing tag */
        \esc_html__('Buy %1$sFlexible PDF Coupons PRO - Advanced Sending →%2$s and enable options below', 'flexible-quantity-measurement-price-calculator-for-woocommerce'),
        \sprintf('<a href="%s" target="_blank" class="sending-link">', \esc_url(Links::get_fcs_link()) . '&utm_content=&utm_content=edit-product'),
        '</a>'
    );
    echo '</p>';
}
$renderer->output_render('fields/delay-type', ['post_meta' => $post_meta, 'post_id' => $prod_post_id, 'is_sending' => $is_sending, 'is_variation' => \false, 'custom_attributes' => $custom_attributes]);
?>
		<div class="show_if_simple_delay">
			<?php 
$renderer->output_render('fields/delay-interval', ['post_meta' => $post_meta, 'post_id' => $prod_post_id, 'is_sending' => $is_sending]);
$renderer->output_render('fields/delay-value', ['post_meta' => $post_meta, 'post_id' => $prod_post_id, 'is_sending' => $is_sending]);
?>
		</div>
		<div class="show_if_fixed_date_delay">
			<?php 
$renderer->output_render('fields/delay-fixed-date', ['post_meta' => $post_meta, 'post_id' => $prod_post_id, 'is_sending' => $is_sending]);
?>
		</div>
		<?php 
$renderer->output_render('fields/expiring-date', ['post_meta' => $post_meta, 'post_id' => $prod_post_id, 'is_premium' => $is_premium]);
$renderer->output_render('fields/expiring-date-own', ['post_meta' => $post_meta, 'post_id' => $prod_post_id, 'is_premium' => $is_premium]);
$renderer->output_render('fields/free-shipping', ['post_meta' => $post_meta, 'post_id' => $prod_post_id, 'is_premium' => $is_premium]);
$renderer->output_render('fields/include-products', ['post_meta' => $post_meta, 'post_id' => $prod_post_id, 'is_premium' => $is_premium]);
$renderer->output_render('fields/include-categories', ['post_meta' => $post_meta, 'post_id' => $prod_post_id, 'is_premium' => $is_premium]);
?>
	</div>
</div>
<?php 
