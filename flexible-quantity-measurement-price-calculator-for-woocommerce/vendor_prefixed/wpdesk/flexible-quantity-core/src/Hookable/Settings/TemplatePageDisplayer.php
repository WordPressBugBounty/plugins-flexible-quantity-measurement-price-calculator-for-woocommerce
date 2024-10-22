<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Settings;

use WDFQVendorFree\WPDesk\Translation\Translate;
use WDFQVendorFree\WPDesk\View\Renderer\Renderer;
use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Units;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Services\SettingsBagFactory;
use WDFQVendorFree\WPDesk\Persistence\Adapter\WordPress\WordpressPostMetaContainer;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\PostType\FQTemplateType;
class TemplatePageDisplayer implements Hookable
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
     * @var bool
     */
    private $is_locked;
    public function __construct(Renderer $renderer, Translate $translate, bool $is_locked)
    {
        $this->renderer = $renderer;
        $this->translate = $translate;
        $this->is_locked = $is_locked;
    }
    public function hooks(): void
    {
        // we didn't want to put it in metaboxes
        \add_action('edit_form_after_title', [$this, 'render_selection']);
        \add_action('edit_form_after_editor', [$this, 'render_template']);
        if ($this->is_locked) {
            add_filter('fcm/custom_units', '__return_empty_array');
        }
    }
    /**
     * @param \WP_Post $post Post object.
     *
     * @return void
     */
    public function render_selection($post)
    {
        if ($post->post_type !== FQTemplateType::POST_TYPE) {
            return;
        }
        $selection_category = \get_post_meta($post->ID, TemplatePageSaver::SELECTION_CATEGORY_META_KEY, \true);
        $pre_select_product_id = 0;
        if (!$selection_category && $this->is_create_template_from_product_redirection()) {
            $selection_category = 'products';
            $pre_select_product_id = $this->get_create_template_from_product_query_var();
        }
        if ($this->is_assign_product_to_template_redirection()) {
            $selection_category = 'products';
            $pre_select_product_id = $this->get_assign_product_to_template_query_var();
        }
        $this->renderer->output_render('settings/selection-section', ['selection_category' => $selection_category, 'pre_select_product_id' => $pre_select_product_id, 'nonce_name' => TemplatePageSaver::NONCE_NAME, 'nonce_action' => TemplatePageSaver::NONCE_ACTION, 'translate' => $this->translate]);
    }
    /**
     * @param \WP_Post $post Post object.
     *
     * @return void
     */
    public function render_template($post)
    {
        if ($post->post_type !== FQTemplateType::POST_TYPE) {
            return;
        }
        $template_id = $post->ID;
        if ($this->is_create_template_from_product_redirection()) {
            $template_id = $this->get_create_template_from_product_query_var();
        }
        $settings_bag = (new SettingsBagFactory(new WordpressPostMetaContainer($template_id)))->create();
        $this->renderer->output_render('settings/template-section', ['settings' => $settings_bag, 'translate' => $this->translate, 'renderer' => $this->renderer, 'is_locked' => $this->is_locked, 'available_units' => Units::get_all(), 'current_currency' => \get_woocommerce_currency_symbol()]);
    }
    private function get_create_template_from_product_query_var(): int
    {
        if (empty($_GET[ProductPage::CREATE_FROM_PRODUCT_VAR_NAME])) {
            return 0;
        }
        return \absint($_GET[ProductPage::CREATE_FROM_PRODUCT_VAR_NAME]);
    }
    private function get_assign_product_to_template_query_var(): int
    {
        if (empty($_GET[ProductPage::ASSIGN_PRODUCT_VAR_NAME])) {
            return 0;
        }
        return \absint($_GET[ProductPage::ASSIGN_PRODUCT_VAR_NAME]);
    }
    private function is_create_template_from_product_redirection(): bool
    {
        return $this->get_create_template_from_product_query_var() > 0;
    }
    private function is_assign_product_to_template_redirection(): bool
    {
        return $this->get_assign_product_to_template_query_var() > 0;
    }
}
