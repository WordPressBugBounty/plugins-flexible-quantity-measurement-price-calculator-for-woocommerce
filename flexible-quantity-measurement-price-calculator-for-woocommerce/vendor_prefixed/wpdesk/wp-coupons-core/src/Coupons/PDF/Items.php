<?php

/**
 * PDF items.
 *
 * @package WPDesk\Library\WPCoupons
 */
namespace WDFQVendorFree\WPDesk\Library\WPCoupons\PDF;

use Exception;
/**
 * @package WPDesk\Library\WPCoupons\PDF
 */
class Items
{
    /**
     * @var array
     */
    private $objects;
    /**
     * Pass objects to the class.
     *
     * @param array $objects
     */
    public function __construct(array $objects)
    {
        $this->objects = $objects;
    }
    /**
     * @return array
     */
    private function default_object_data(): array
    {
        return ['title' => '', 'width' => '', 'realWidth' => '', 'height' => '', 'realHeight' => '', 'top' => '', 'left' => '', 'rotate' => '0', 'url' => '', 'type' => 'image', 'rotateAngle' => 'image', 'textAlign' => 'left'];
    }
    /**
     * @return string
     */
    private function rtl_dir(): string
    {
        if (is_rtl()) {
            return 'dir = "rtl"';
        }
        return '';
    }
    /**
     * Define inline styles for object and return HTML.
     *
     * @param array $object
     *
     * @return string
     */
    private function get_image_html(array $object): string
    {
        $styles = '
		transform: rotate(' . $object['rotateAngle'] . 'deg);
		position: absolute;
		top: ' . $object['top'] . 'px;
		left: ' . $object['left'] . 'px;
		width: ' . $object['width'] . 'px;
		height: ' . $object['height'] . 'px;
		background: transparent url(' . $object['url'] . ') 0 0 no-repeat;
		background-size: ' . $object['width'] . 'px ' . $object['height'] . 'px;
		';
        return '<div ' . $this->rtl_dir() . ' class="image" style="' . $styles . '"></div>';
    }
    /**
     * Define inline styles for text item and return HTML.
     *
     * @param array $object Editor object.
     *
     * @return string
     */
    private function get_text_html(array $object): string
    {
        $color = '#000';
        if (isset($object['color']['r'])) {
            $color = 'rgba(' . $object['color']['r'] . ', ' . $object['color']['g'] . ', ' . $object['color']['b'] . ', ' . $object['color']['a'] . ' )';
        }
        $styles = '
		font-family: ' . $this->sanitize_font_name($object['fontFamily']) . ';
		text-align: ' . $object['textAlign'] . ';
		position: absolute;
		top: ' . $object['top'] . 'px;
		left: ' . $object['left'] . 'px;
		font-size: ' . $object['fontSize'] . 'px;
		color: ' . $color . ';
		width: ' . $object['width'] . 'px;
		height: ' . $object['height'] . 'px';
        return '<' . $object['tag'] . ' ' . $this->rtl_dir() . ' style="' . $styles . '">' . nl2br($object['text']) . '</' . $object['tag'] . '>';
    }
    /**
     * Sanitize font name. All font names must be lowecase.
     *
     * @param string $font_name Font name.
     *
     * @return string
     */
    private function sanitize_font_name(string $font_name): string
    {
        return strtolower(trim(str_replace(['+', ' '], '', $font_name)));
    }
    /**
     * @return string
     *
     * @throws Exception Throw if object type is invalid.
     */
    public function get_html(): string
    {
        $objects = '';
        foreach ($this->objects as $object) {
            $object = wp_parse_args($object, $this->default_object_data());
            switch ($object['type']) {
                case 'image':
                    $objects .= $this->get_image_html($object);
                    break;
                case 'text':
                    $objects .= $this->get_text_html($object);
                    break;
                case 'qr_code':
                    $objects .= \apply_filters('core/pdf/items/get_qr_code_html', $object);
                    break;
                default:
                    throw new Exception('Unknown object passed from editor');
            }
        }
        return $objects;
    }
}
