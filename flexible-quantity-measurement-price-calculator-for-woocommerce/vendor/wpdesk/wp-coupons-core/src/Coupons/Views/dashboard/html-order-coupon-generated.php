<?php
/**
 * Part of order metabox template
 */

$used_classname = '';
if ( isset( $coupon_is_used ) && $coupon_is_used ) {
	$used_classname = 'has-been-used';
}
?>
<div><strong><?php esc_html_e( 'Coupon code:', 'wp-coupons-core' ); ?></strong> <a class="<?php echo esc_attr( $used_classname ); ?>" href="<?php echo esc_url( $coupon_url ); ?>"><?php echo esc_html( $coupon_code ); ?></a></div>
<hr />
<a class="view_coupon button button-secondary" href="<?php echo esc_url( $download_url ); ?>&view=1" target="_blank" title="<?php esc_attr_e( 'View PDF', 'wp-coupons-core' ); ?>"><?php esc_html_e( 'View', 'wp-coupons-core' ); ?></a>
<a class="download_coupon button button-secondary" href="<?php echo esc_url( $download_url ); ?>" target="_blank" title="<?php esc_attr_e( 'Download PDF coupon', 'wp-coupons-core' ); ?>"><?php esc_html_e( 'Download', 'wp-coupons-core' ); ?></a>
