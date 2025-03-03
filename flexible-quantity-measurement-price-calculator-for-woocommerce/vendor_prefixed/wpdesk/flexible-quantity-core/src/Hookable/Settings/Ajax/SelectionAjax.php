<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Settings\Ajax;

use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Template\Selection\Options\OptionsProvider;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Template\Selection\Options\TagOptionsProvider;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Template\Selection\Options\NullOptionsProvider;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Template\Selection\Options\ProductOptionsProvider;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\Template\Selection\Options\CategoryOptionsProvider;
class SelectionAjax implements Hookable
{
    /**
     * @var bool
     */
    private $is_locked;
    public const ACTION_GET_OPTIONS = 'get_options';
    public const ACTION_GET_SELECTED = 'get_selected_options';
    public const NONCE_CONTEXT = 'woo-products-nonce';
    public function __construct(bool $is_locked)
    {
        $this->is_locked = $is_locked;
    }
    public function hooks()
    {
        add_action('wp_ajax_' . self::ACTION_GET_OPTIONS, [$this, 'get_options']);
        add_action('wp_ajax_' . self::ACTION_GET_SELECTED, [$this, 'get_selected_options']);
    }
    public function get_options(): void
    {
        if (!isset($_REQUEST['nonce']) || !\wp_verify_nonce(\sanitize_key(\wp_unslash($_REQUEST['nonce'])), self::NONCE_CONTEXT)) {
            \wp_send_json_error('Invalid nonce');
        }
        if (!isset($_REQUEST['category'])) {
            \wp_send_json_error('Required field "category" is not set');
        }
        $category = \sanitize_text_field(\wp_unslash($_REQUEST['category']));
        $page = isset($_REQUEST['page']) ? (int) $_REQUEST['page'] : 1;
        $search = isset($_REQUEST['search']) ? \sanitize_text_field(\wp_unslash($_REQUEST['search'])) : '';
        $option_provider = $this->get_option_provider($category);
        $option_provider->set_search($search);
        $option_provider->set_page($page);
        \wp_send_json_success($option_provider->get_options($this->is_locked));
    }
    public function get_selected_options()
    {
        if (!isset($_POST['nonce']) || !\wp_verify_nonce(\sanitize_key(\wp_unslash($_POST['nonce'])), self::NONCE_CONTEXT)) {
            \wp_send_json_error('Invalid nonce');
        }
        if (!isset($_POST['category'], $_POST['template_id'])) {
            \wp_send_json_error('Required fields "category" or "template_id" are not set');
        }
        $category = \sanitize_text_field(\wp_unslash($_POST['category']));
        $template_id = \absint($_POST['template_id']);
        $preselected_product_id = isset($_POST['pre_select_product_id']) ? \absint($_POST['pre_select_product_id']) : 0;
        $option_provider = $this->get_option_provider($category);
        \wp_send_json_success($option_provider->get_selected_options($template_id, $preselected_product_id));
    }
    /**
     * @param string $category
     *
     * @return OptionsProvider
     */
    private function get_option_provider(string $category): OptionsProvider
    {
        switch ($category) {
            case 'products':
                return new ProductOptionsProvider($this->is_locked);
            case 'product_categories':
                return new CategoryOptionsProvider();
            case 'product_tags':
                return new TagOptionsProvider();
            default:
                return new NullOptionsProvider();
        }
    }
}
