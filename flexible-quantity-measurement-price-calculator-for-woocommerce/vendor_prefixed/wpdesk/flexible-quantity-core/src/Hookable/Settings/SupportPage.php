<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Settings;

use WDFQVendorFree\WPDesk\Translation\Translate;
use WDFQVendorFree\WPDesk\View\Renderer\Renderer;
use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable;
use WDFQVendorFree\WPDesk\Library\Marketing\Boxes\Assets;
use WDFQVendorFree\WPDesk\View\Renderer\SimplePhpRenderer;
use WDFQVendorFree\WPDesk\Library\Marketing\Boxes\MarketingBoxes;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\PostType\FQTemplateType;
class SupportPage implements \WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable
{
    /**
     * @var SimplePhpRenderer
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
     * @var string
     */
    private $marketing_slug;
    /**
     * @var bool
     */
    private $is_locked;
    private const MENU_POSITION = 7;
    private const MENU_SLUG = 'flexible_quantity_instructions';
    public function __construct(\WDFQVendorFree\WPDesk\View\Renderer\Renderer $renderer, \WDFQVendorFree\WPDesk\Translation\Translate $translate, string $assets_url, string $script_version, string $marketing_slug, bool $is_locked)
    {
        $this->renderer = $renderer;
        $this->translate = $translate;
        $this->assets_url = $assets_url;
        $this->script_version = $script_version;
        $this->marketing_slug = $marketing_slug;
        $this->is_locked = $is_locked;
    }
    public function hooks()
    {
        \add_action('admin_menu', [$this, 'add_submenu_page'], 9999);
        \add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_scripts']);
    }
    public function add_submenu_page()
    {
        \add_submenu_page('edit.php?post_type=' . \WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\PostType\FQTemplateType::POST_TYPE, \esc_html__('Start here', 'flexible-quantity-measurement-price-calculator-for-woocommerce'), '<span style="color: #00FFC2;">' . \esc_html__('Start here', 'flexible-quantity-measurement-price-calculator-for-woocommerce') . '</span>', 'manage_options', self::MENU_SLUG, [$this, 'render'], self::MENU_POSITION);
    }
    public function render()
    {
        $local = \get_locale();
        if ($local === 'en_US') {
            $local = 'en';
        }
        $boxes = new \WDFQVendorFree\WPDesk\Library\Marketing\Boxes\MarketingBoxes($this->marketing_slug, $local);
        $this->renderer->output_render('settings/marketing-page', ['boxes' => $boxes, 'translate' => $this->translate, 'is_locked' => $this->is_locked]);
    }
    /**
     * @param string $screen_id
     */
    public function admin_enqueue_scripts($screen_id)
    {
        if (!\in_array($screen_id, [\WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\PostType\FQTemplateType::POST_TYPE . '_page_' . self::MENU_SLUG], \true)) {
            return;
        }
        \WDFQVendorFree\WPDesk\Library\Marketing\Boxes\Assets::enqueue_assets();
        \WDFQVendorFree\WPDesk\Library\Marketing\Boxes\Assets::enqueue_owl_assets();
        \wp_enqueue_style('fq-admin', $this->assets_url . '/css/admin.css', [], $this->script_version);
    }
}
