<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Settings;

use WDFQVendorFree\WPDesk\Translation\Translate;
use WDFQVendorFree\WPDesk\View\Renderer\Renderer;
use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\PostType\FQTemplateType;
class CustomUnitsPage implements \WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable
{
    /**
     * @var Renderer
     */
    private $renderer;
    /**
     * @var Translate
     */
    private $translate;
    /**
     * @var string
     */
    private $assets_url;
    /**
     * @var string
     */
    private $script_version;
    /**
     * @var bool
     */
    private $is_locked;
    private const MENU_POSITION = 5;
    private const NONCE_NAME = 'fq_NONCE_NAME';
    private const NONCE_ACTION = 'fq_NONCE_ACTION';
    public const MENU_SLUG = 'flexible_quantity_custom_units';
    public const OPTION_NAME = 'flexible_quantity_custom_units';
    public const FORM_UNIT = 'custom_units';
    public const FORM_UNIT_NAME = 'name';
    public function __construct(\WDFQVendorFree\WPDesk\View\Renderer\Renderer $renderer, \WDFQVendorFree\WPDesk\Translation\Translate $translate, string $assets_url, string $script_version, bool $is_locked)
    {
        $this->renderer = $renderer;
        $this->translate = $translate;
        $this->assets_url = $assets_url;
        $this->script_version = $script_version;
        $this->is_locked = $is_locked;
    }
    public function hooks()
    {
        \add_action('admin_menu', [$this, 'add_submenu_page'], 9999);
        \add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_scripts']);
    }
    public function add_submenu_page()
    {
        \add_submenu_page('edit.php?post_type=' . \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\PostType\FQTemplateType::POST_TYPE, \esc_html__('Custom units', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), \esc_html__('Custom units', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), 'manage_options', self::MENU_SLUG, [$this, 'render'], self::MENU_POSITION);
    }
    public function render()
    {
        $this->save_form_data_if_needed();
        $units = \get_option(self::OPTION_NAME);
        $units = \is_array($units) && \count($units) > 0 ? $units : [null];
        $this->renderer->output_render('settings/custom-units-page', ['units' => $units, 'translate' => $this->translate, 'renderer' => $this->renderer, 'is_locked' => $this->is_locked, 'nonce_action' => self::NONCE_ACTION, 'nonce_name' => self::NONCE_NAME, 'is_save' => $this->is_save_form_data_request()]);
    }
    public function is_save_form_data_request()
    {
        return isset($_POST[self::FORM_UNIT]);
    }
    private function save_form_data_if_needed()
    {
        if ($this->is_save_form_data_request() && $this->validate_form_data()) {
            $save_data = [];
            foreach ($_POST[self::FORM_UNIT][self::FORM_UNIT_NAME] as $unit) {
                $unit_name = \sanitize_text_field(\trim($unit));
                if (!empty($unit_name)) {
                    $save_data[][self::FORM_UNIT_NAME] = $unit_name;
                }
            }
            \update_option(self::OPTION_NAME, $save_data);
        }
    }
    private function validate_form_data()
    {
        if ($this->is_locked) {
            return \false;
        }
        if (!\wp_verify_nonce(isset($_POST[self::NONCE_NAME]) ? $_POST[self::NONCE_NAME] : '', self::NONCE_ACTION)) {
            \wp_die('Error, security code is not valid');
        }
        if (!\current_user_can('manage_options')) {
            \wp_die('Error, you are not allowed to do this action');
        }
        return \true;
    }
    /**
     * @param string $screen_id
     */
    public function admin_enqueue_scripts($screen_id)
    {
        if (\false === \strpos($screen_id, self::MENU_SLUG)) {
            return;
        }
        \wp_enqueue_style('fq-admin', $this->assets_url . '/css/admin.css', [], $this->script_version);
        \wp_enqueue_script('jquery-tiptip');
        \wp_enqueue_script('fq-custom-units', $this->assets_url . '/js/settings.js', ['jquery', 'jquery-tiptip'], $this->script_version, \true);
    }
}
