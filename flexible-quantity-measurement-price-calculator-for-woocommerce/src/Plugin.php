<?php
/**
 * Plugin main class.
 *
 * @package WPDesk\FlexibleQuantity
 */

namespace WPDesk\FlexibleQuantityFree;

use WDFQVendorFree\Psr\Log\NullLogger;
use WDFQVendorFree\Psr\Log\LoggerAwareTrait;
use WDFQVendorFree\Psr\Log\LoggerAwareInterface;
use WDFQVendorFree\WPDesk_Plugin_Info;
use WDFQVendorFree\WPDesk\View\Renderer\Renderer;
use WDFQVendorFree\WPDesk\Dashboard\DashboardWidget;
use WDFQVendorFree\WPDesk\View\Resolver\DirResolver;
use WDFQVendorFree\WPDesk\Logger\SimpleLoggerFactory;
use WDFQVendorFree\WPDesk\View\Resolver\ChainResolver;
use WDFQVendorFree\WPDesk\View\Renderer\SimplePhpRenderer;
use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\AbstractPlugin;
use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\HookableParent;
use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\HookableCollection;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\PluginConfig;

/**
 * Main plugin class. The most important flow decisions are made here.
 *
 * @codeCoverageIgnore
 */
class Plugin extends AbstractPlugin implements LoggerAwareInterface, HookableCollection {

	use LoggerAwareTrait;
	use HookableParent;

	/**
	 * @var string
	 */
	const SCRIPTS_VERSION = '2.' . FLEXIBLE_QUANTITY_FREE_VERSION;

		/**
	 * @var string
	 */
	const MARKETING_SLUG = 'flexible-quantity';

	/**
	 * Renderer.
	 *
	 * @var Renderer
	 */
	private $renderer;

	/**
	 * @var string
	 */
	private $plugin_path;

	/**
	 * @var PluginConfig
	 */
	private $plugin_config;

	public const PLUGIN_CORE_PATH = '/vendor_prefixed/wpdesk/flexible-quantity-core';

	private const LOGGER_CHANNEL = 'wpdesk-flexible-quantity';

	/**
	 * Plugin constructor.
	 *
	 * @param WPDesk_Plugin_Info $plugin_info Plugin info.
	 */
	public function __construct( WPDesk_Plugin_Info $plugin_info ) {
		parent::__construct( $plugin_info );
		$this->plugin_url  = $this->plugin_info->get_plugin_url();
		$this->plugin_path = $this->plugin_info->get_plugin_dir();
		$this->create_plugin_config( $plugin_info );
	}

	private function create_plugin_config( WPDesk_Plugin_Info $plugin_info ) {
		$this->plugin_config = new PluginConfig(
			$this->plugin_url,
			$this->plugin_path,
			self::PLUGIN_CORE_PATH,
			self::SCRIPTS_VERSION,
			self::MARKETING_SLUG
		);
	}

	/**
	 * Init plugin.
	 */
	public function init() {
		$this->init_renderer();
		$this->init_logger();
		parent::init();
	}

	/**
	 * Init renderer.
	 */
	private function init_renderer() {
		$resolver = new ChainResolver();
		$resolver->appendResolver( new DirResolver( $this->plugin_path . '/src/Views/' ) );
		$resolver->appendResolver( new DirResolver( get_stylesheet_directory() . '/templates/' ) );
		$resolver->appendResolver( new DirResolver( $this->plugin_path . self::PLUGIN_CORE_PATH . '/src/Views/' ) );
		$resolver->appendResolver( new DirResolver( get_stylesheet_directory() . self::PLUGIN_CORE_PATH . '/templates/' ) );
		$this->renderer = new SimplePhpRenderer( $resolver );
	}

	/**
	 * Init logger.
	 */
	private function init_logger() {
		$this->setLogger(
			$this->is_debug_mode()
				? ( new SimpleLoggerFactory( self::LOGGER_CHANNEL ) )->getLogger()
				: new NullLogger()
		);
	}

	/**
	 * Init hooks.
	 */
	public function hooks() {
		parent::hooks();
		add_action( 'woocommerce_init', [ $this, 'woocommerce_init' ] );
		// stock amounts are *not* integers by default.
		remove_filter( 'woocommerce_stock_amount', 'intval' );
		// so let them be.
		add_filter( 'woocommerce_stock_amount', 'floatval' );
	}

	/**
	 * Initializes Measurement Price Calculator when WooCommerce is ready.
	 *
	 * @internal
	 * @since    3.0
	 */
	public function woocommerce_init() {
		if ( $this->check_if_pro_version_is_installed() ) {
			return;
		}

		foreach ( $this->plugin_config->get_hookable_elements() as $hookable ) {
			$this->add_hookable( $hookable );
		}

		$this->hooks_on_hookable_objects();
		( new DashboardWidget() )->hooks();
	}


	/**
	 * Returns true when debug mode is on.
	 *
	 * @return bool
	 */
	private function is_debug_mode() {
		$helper_options = get_option( 'wpdesk_helper_options', [] );

		return isset( $helper_options['debug_log'] ) && '1' === $helper_options['debug_log'];
	}

	public function links_filter( $links ) {
		unset( $links['0'] );
		$is_pl        = 'pl_PL' === get_locale();
		$support_url  = $is_pl ? 'https://www.wpdesk.pl/support/' : 'https://www.wpdesk.net/get-support/';
		$settings_url = admin_url( 'admin.php?page=flexible_quantity_instructions' );
		$docs_url     = $is_pl ? 'https://wpdesk.link/flexible-quantity-pl' : 'https://wpdesk.link/flexible-quantity-main';

		$plugin_links['docs']     = '<a href="' . esc_url( $docs_url ) . '" target="_blank">' . esc_html__( 'Documentation', 'flexible-quantity-measurement-price-calculator-for-woocommerce' ) . '</a>';
		$plugin_links['settings'] = '<a href="' . esc_url( $settings_url ) . '" target="_blank" style="color:#d64e07;font-weight:bold;">' . esc_html__( 'How to use', 'flexible-quantity-measurement-price-calculator-for-woocommerce' ) . '</a>';
		$plugin_links['support']  = '<a href="' . esc_url( $support_url ) . '" target="_blank">' . esc_html__( 'Support', 'flexible-quantity-measurement-price-calculator-for-woocommerce' ) . '</a>';

		return array_merge( $plugin_links, $links );
	}

	public function check_if_pro_version_is_installed() {
		if ( ! function_exists( 'is_plugin_active' ) ) {
			include_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		if ( \is_admin() && \current_user_can( 'activate_plugins' ) && \is_plugin_active( 'flexible-quantity/flexible-quantity.php' ) ) {
			add_action( 'admin_notices', [ $this, 'plugin_notice' ] );
			deactivate_plugins( plugin_basename( $this->get_plugin_file_path() ) );
			return true;
		}
		return false;
	}

	public function plugin_notice() {
		$allowed_tags = [
			'p'   => [],
			'div' => [
				'class' => [],
			],
		];
		echo wp_kses( '<div class="error"><p>' . __( 'Free version of plugin Flexible Quantity for WooCommerce was deactivated because Pro version is active.', 'flexible-quantity-measurement-price-calculator-for-woocommerce' ) . '</p></div>', $allowed_tags );
	}
}
