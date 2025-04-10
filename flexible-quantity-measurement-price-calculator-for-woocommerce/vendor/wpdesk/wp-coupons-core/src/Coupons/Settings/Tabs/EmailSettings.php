<?php

namespace WPDesk\Library\WPCoupons\Settings\Tabs;

use WPDesk\Forms\Field;
use WPDesk\Forms\Field\Header;
use WPDesk\Forms\Field\NoOnceField;
use WPDesk\Forms\Field\SubmitField;
use WPDesk\Forms\Field\CheckboxField;
use WPDesk\Forms\Field\InputTextField;
use WPDesk\Library\WPCoupons\Helpers\Links;
use WPDesk\Library\WPCoupons\Helpers\EmailStrings;
use WPDesk\Library\WPCoupons\Settings\SettingsForm;
use WPDesk\Library\WPCoupons\Settings\Fields\LinkField;
use WPDesk\Library\WPCoupons\Settings\Fields\WysiwygField;
use WPDesk\Library\WPCoupons\Settings\Fields\DisableFieldProAdapter;
use WPDesk\Library\WPCoupons\Settings\Fields\MultipleInputTextField;

/**
 * Main Settings Tab Page.
 *
 * @package WPDesk\Library\WPCoupons\Settings\Tabs
 */
class EmailSettings extends FieldSettingsTab {

	/** @var string field names */
	const ATTACH_COUPON_FIELD = 'attach_coupon';

	/**
	 * @return array|Field[]
	 */
	protected function get_fields(): array {
		$is_pl        = 'pl_PL' === get_locale();
		$precise_docs = $is_pl ? '&utm_content=emails-settings#emaile' : '&utm_content=emails-settings#Emails';
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
			( new Header() )
				->set_name( '' )
				->set_label( \esc_html__( 'Email settings', 'wp-coupons-core' ) )
				->set_description( __( 'For more specific email delay settings, visit the product edit page.', 'wp-coupons-core' ) ),
			( new DisableFieldProAdapter(
				'',
				( new LinkField() )
					->set_label(
						sprintf(
							/* translators: %1$s: anchor opening tag, %2$s: anchor closing tag */
							__( '%1$sUpgrade to PRO →%2$s and enable options below', 'wp-coupons-core' ),
							sprintf(
								'<a href="%s" target="_blank" class="pro-link">',
								esc_url( Links::get_pro_link() . '&utm_content=emails-settings' )
							),
							'</a>'
						)
					)
			) )->get_field(),
			( new DisableFieldProAdapter(
				self::ATTACH_COUPON_FIELD,
				( new CheckboxField() )
					->set_name( '' )
					->set_label( \esc_html__( 'Attachments in the e-mail', 'wp-coupons-core' ) )
					->set_sublabel( \esc_html__( 'Attach PDF file to coupon email', 'wp-coupons-core' ) )
			) )->get_field(),
			( new LinkField() )
				->set_label(
					sprintf(
						/* translators: %1$s: anchor opening tag, %2$s: anchor closing tag */
						__( 'Buy %1$sFlexible PDF Coupons PRO - Advanced Sending →%2$s and enable options below', 'wp-coupons-core' ),
						sprintf(
							'<a href="%s" target="_blank" class="sending-link">',
							esc_url( Links::get_fcs_link() . '&utm_content=emails-settings' )
						),
						'</a>'
					)
				)
				->set_disabled(),
			( new DisableFieldProAdapter(
				'',
				( new LinkField() )
					->set_label(
						sprintf(
							/* translators: %1$s: anchor opening tag, %2$s: anchor closing tag */
							__( '%1$sGet Flexible Coupons PRO with add-ons in one Bundle →%2$s', 'wp-coupons-core' ),
							sprintf(
								'<a href="%s" target="_blank" class="pro-link">',
								esc_url( Links::get_bundle_link() . '&utm_content=emails-settings' ),
							),
							'</a>'
						)
					)
					->add_class( 'pro-link-wrapper' )
			) )->get_field(),
			( new MultipleInputTextField() )
					->set_name( '' )
					->set_label( \esc_html__( 'Additional recipients', 'wp-coupons-core' ) )
					->set_placeholder( \esc_html__( 'E-mail address', 'wp-coupons-core' ) )
					->set_description( \esc_html__( 'Add additional recipients', 'wp-coupons-core' ) )
					->set_disabled()
					->set_readonly()
					->add_class( 'form-table-field' ),
			( new InputTextField() )
					->set_name( '' )
					->set_label( __( 'Email subject', 'wp-coupons-core' ) )
					->set_placeholder( EmailStrings::get_default_email_subject() )
					->set_default_value( EmailStrings::get_default_email_subject() )
					->set_description( __( 'You can use the following placeholders: {recipient_name}, {recipient_message}, {recipient_email}, {buyer_name}, {coupon_url}, {coupon_code}, {coupon_value}, {coupon_expiry}, {site_title}, {site_url}, {admin_email}, {current_date}, {site_description}', 'wp-coupons-core' ) )
					->set_disabled()
					->set_readonly(),
			( new WysiwygField() )
					->set_name( '' )
					->set_label( __( 'E-mail body', 'wp-coupons-core' ) )
					->set_default_value( EmailStrings::get_default_email_body() )
					->set_description( __( 'You can use the following placeholders: {recipient_name}, {recipient_message}, {recipient_email}, {buyer_name}, {coupon_url}, {coupon_code}, {coupon_value}, {coupon_expiry}, {site_title}, {site_url}, {admin_email}, {current_date}, {site_description}', 'wp-coupons-core' ) )
					->set_disabled()
					->set_readonly(),
			( new NoOnceField( SettingsForm::NONCE_ACTION ) )
				->set_name( SettingsForm::NONCE_NAME ),
			( new SubmitField() )
				->set_attribute( 'id', 'save_settings' )
				->set_name( 'save_settings' )
				->set_label( \esc_html__( 'Save Changes', 'wp-coupons-core' ) )
				->add_class( 'button-primary' ),
		];

		return \apply_filters( 'fcpdf/settings/general/fields', $fields, $this->get_tab_slug() );
	}

	/**
	 * @return string
	 */
	public static function get_tab_slug(): string {
		return 'emails';
	}

	/**
	 * @return string
	 */
	public function get_tab_name(): string {
		return __( 'Emails', 'wp-coupons-core' );
	}
}
