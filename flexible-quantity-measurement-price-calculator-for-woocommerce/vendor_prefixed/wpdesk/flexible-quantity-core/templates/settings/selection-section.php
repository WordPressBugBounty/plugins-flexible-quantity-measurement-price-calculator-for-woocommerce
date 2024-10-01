<?php

namespace WDFQVendorFree;

/**
 * Template for selection section in settings page.
 */
?>
<section class="selection">
	<header>
		<?php 
\esc_html_e('Select the product(s), product categories or tags for which you are creating a template. ', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?>
		<div class="bold">
			<?php 
\printf(
    /* translators: %1$s and %2$s: anchor opening and closing tags with right arrow */
    \esc_html__('Read more in the %1$splugin documentation%2$s', 'flexible-quantity-measurement-price-calculator-for-woocommerce'),
    '<a href="' . \esc_url($translate->__('url.docs.template.selection')) . '" target="_blank" class="link-docs">',
    ' →</a>'
);
?>
		</div>
	</header>
	<fieldset>
		<?php 
\wp_nonce_field($nonce_action, $nonce_name);
?>
		<div>
			<label for="fq_selection_category"><?php 
\esc_html_e('I am creating template for', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?>:</label>
			<select id="fq_selection_category" name="fq_selection_category">
				<option value=""><?php 
\esc_html_e('Template category', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?></option>
				<option value="products" <?php 
\selected($selection_category, 'products');
?>><?php 
\esc_html_e('Products', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?></option>
				<option value="product_categories" <?php 
\selected($selection_category, 'product_categories');
?>><?php 
\esc_html_e('Products categories', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?></option>
				<option value="product_tags" <?php 
\selected($selection_category, 'product_tags');
?>><?php 
\esc_html_e('Tags', 'flexible-quantity-measurement-price-calculator-for-woocommerce');
?></option>
			</select>
		</div>
		<div>
			<select id="fq_selections" name="fq_selections[]" multiple data-pre-select-product-id="<?php 
echo \esc_attr($pre_select_product_id);
?>">
			<!-- Options will be dynamically populated based on the selection in the first select -->
			</select>
		</div>
	</fieldset>
</section>
<?php 
