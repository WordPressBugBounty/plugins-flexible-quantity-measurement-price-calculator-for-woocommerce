<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\Settings;

use WDFQVendorFree\WPDesk\PluginBuilder\Plugin\Hookable;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\WooCommerce\Settings;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\TemplatePersistentContainer;
use WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Hookable\PostType\FQTemplateType;
class TemplatePageSaver implements Hookable
{
    public const NONCE_ACTION = 'fq_save_template_nonce';
    public const NONCE_NAME = 'fq_nonce';
    public const SELECTION_CATEGORY_META_KEY = 'selection_category';
    public function hooks(): void
    {
        \add_action('save_post_' . FQTemplateType::POST_TYPE, [$this, 'save'], 10, 2);
    }
    public function save(int $post_id, \WP_Post $post): void
    {
        if (!isset($_POST[self::NONCE_NAME], $_POST['fq_selection_category'], $_POST['fq']) || !is_array($_POST['fq'])) {
            return;
        }
        if (!\wp_verify_nonce(\sanitize_key($_POST[self::NONCE_NAME]), self::NONCE_ACTION)) {
            return;
        }
        if ($post->post_type !== FQTemplateType::POST_TYPE) {
            return;
        }
        $selection_category = \sanitize_text_field(\wp_unslash($_POST['fq_selection_category']));
        $selections = \array_filter(\wc_clean(\wp_unslash($_POST['fq_selections'] ?? [])), 'is_numeric');
        $raw_settings = ['fq' => \wc_clean(\wp_unslash($_POST['fq']))];
        $container = new TemplatePersistentContainer($post_id);
        $container->set(Settings::SETTINGS_META_KEY, $raw_settings);
        $container->set(Settings::SETTINGS_META_KEY . '_hash', md5(\wp_json_encode($raw_settings)));
        $container->set(self::SELECTION_CATEGORY_META_KEY, $selection_category);
        $container->delete('product_id');
        $container->delete('category_id');
        $container->delete('tag_id');
        $meta_key = $this->get_selection_meta_key_by_category($selection_category);
        foreach ($selections as $selection_id) {
            $container->add($meta_key, $selection_id);
        }
    }
    private function get_selection_meta_key_by_category(string $selection_category): string
    {
        switch ($selection_category) {
            case 'products':
                return 'product_id';
            case 'product_categories':
                return 'category_id';
            case 'product_tags':
                return 'tag_id';
            default:
                return '';
        }
    }
}
