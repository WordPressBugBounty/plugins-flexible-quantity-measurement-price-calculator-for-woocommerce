<?php

namespace WPDesk\Library\WPCoupons\Settings\Tabs;

use WPDesk\Forms\Field;
use WPDesk\Forms\Field\Header;
use WPDesk\Forms\Field\Paragraph;
use WPDesk\View\Renderer\Renderer;
use WPDesk\Forms\Field\NoOnceField;
use WPDesk\Forms\Field\SelectField;
use WPDesk\Forms\Field\SubmitField;
use WPDesk\Forms\Field\InputTextField;
use WPDesk\Library\WPCoupons\Helpers\Links;
use WPDesk\Library\WPCoupons\Settings\SettingsForm;
use WPDesk\Library\WPCoupons\Settings\Fields\LinkField;
use WPDesk\Library\WPCoupons\Settings\Fields\DisableFieldProAdapter;

/**
 * Main Settings Tab Page.
 *
 * @package WPDesk\Library\WPCoupons\Settings\Tabs
 */
final class MainSettings extends FieldSettingsTab {

	private $renderer;

	/** @var string field names */
	const FIELD_AUTOMATIC_SENDING     = 'automatic_sending';
	const EXPIRY_DATE_FORMAT_FIELD    = 'expiry_date_format';
	const PRODUCT_PAGE_POSITION_FIELD = 'coupon_product_position';


	public function __construct( Renderer $renderer ) {
		$this->renderer = $renderer;
	}

	/**
	 * @return array|Field[]
	 */
	protected function get_fields(): array {
		$is_pl        = 'pl_PL' === get_locale();
		$precise_docs = $is_pl ? '&utm_content=main-settings#ustawienia-glowne' : '&utm_content=main-settings#Settings';
		$fields       = [
			( new Header() )
				->set_label( '' )
				->set_description(
					sprintf(
						/* translators: %1$s: anchor opening tag, %2$s: anchor closing tag */
						__( 'Read more in the %1$splugin documentation →%2$s', 'wp-coupons-core' ),
						sprintf(
							'<a href="%s" target="_blank" class="docs-link">',
							esc_url( Links::get_doc_link() . $precise_docs )
						),
						'</a><br/>'
					)
				)
				->add_class( 'marketing-content' ),
			( new SelectField() )
				->set_name( self::FIELD_AUTOMATIC_SENDING )
				->set_label( \esc_html__( 'Automatically generate coupons', 'wp-coupons-core' ) )
				->set_options(
					$this->get_wc_order_statuses()
				)
				->set_description( \esc_html__( 'If you want the coupon to be generated automatically, select order status. Coupon will be generated and sent automatically when order status is changed to selected status.', 'wp-coupons-core' ) )
				->set_required()
				->add_class( 'form-table-field' ),
			( new DisableFieldProAdapter(
				'',
				( new LinkField() )
					->set_label(
						sprintf(
							/* translators: %1$s: anchor opening tag, %2$s: anchor closing tag */
							__( '%1$sUpgrade to PRO →%2$s and enable options below', 'wp-coupons-core' ),
							sprintf(
								'<a href="%s" target="_blank" class="pro-link">',
								esc_url( Links::get_pro_link() . '&utm_content=main-settings' )
							),
							'</a>'
						)
					)
			) )->get_field(),
			( new DisableFieldProAdapter(
				self::EXPIRY_DATE_FORMAT_FIELD,
				( new InputTextField() )
					->set_name( '' )
					->set_label( \esc_html__( 'Expiry date format', 'wp-coupons-core' ) )
					->set_description( sprintf( __( 'Define coupon expiry date format according to %1$sWordPress date formatting%2$s.', 'wp-coupons-core' ), '<a href="https://wordpress.org/support/article/formatting-date-and-time/" target="_blank">', '</a>' ) )
					->set_default_value( get_option( 'date_format' ) )
					->add_class( 'form-table-field' ),
			) )->get_field(),
			( new DisableFieldProAdapter(
				self::PRODUCT_PAGE_POSITION_FIELD,
				( new SelectField() )
					->set_name( '' )
					->set_label( \esc_html__( 'Coupon fields position on the product page', 'wp-coupons-core' ) )
					->set_options(
						[
							'below' => \esc_html__( 'Below Add to cart button', 'wp-coupons-core' ),
							'above' => \esc_html__( 'Above Add to cart button', 'wp-coupons-core' ),
						]
					)
					->set_description( \esc_html__( 'Select where the coupon fields will be displayed on the product page.', 'wp-coupons-core' ) )
					->add_class( 'form-table-field' ),
			) )->get_field(),
			( new Paragraph() )
				->set_name( 'php-alow' )
				->set_label( \esc_html__( 'Allow URL Fopen', 'wp-coupons-core' ) )
				->set_description( $this->get_php_settings_message() ),
			( new NoOnceField( SettingsForm::NONCE_ACTION ) )
				->set_name( SettingsForm::NONCE_NAME ),
			( new SubmitField() )
				->set_attribute( 'id', 'save_settings' )
				->set_name( 'save_settings' )
				->set_label( \esc_html__( 'Save Changes', 'wp-coupons-core' ) )
				->add_class( 'button-primary' ),
		];

		return apply_filters( 'fcpdf/settings/general/fields', $fields, $this->get_tab_slug() );
	}

	private function get_wc_order_statuses(): array {
		$statuses = wc_get_order_statuses();
		unset( $statuses['wc-cancelled'], $statuses['wc-refunded'], $statuses['wc-failed'], $statuses['wc-checkout-draft'] );

		return array_merge( [ \esc_html__( 'Do not generate', 'wp-coupons-core' ) ], $statuses );
	}

	private function is_allow_url_fopen_active(): bool {
		return (bool) \ini_get( 'allow_url_fopen' );
	}

	private function get_php_settings_message(): string {
		$is_active = $this->is_allow_url_fopen_active();
		return $this->renderer->render(
			'allow-url-fopen-status',
			[
				'status' => $is_active ? \__( 'Enabled', 'wp-coupons-core' ) : \__( 'Disabled', 'wp-coupons-core' ),
				'color'  => $is_active ? 'green' : 'red',
			]
		);
	}

	/**
	 * @return string
	 */
	public static function get_tab_slug(): string {
		return 'general';
	}

	/**
	 * @return string
	 */
	public function get_tab_name(): string {
		return \esc_html__( 'Main settings', 'wp-coupons-core' );
	}
}
