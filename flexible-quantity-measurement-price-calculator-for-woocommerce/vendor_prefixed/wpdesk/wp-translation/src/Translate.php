<?php

namespace WDFQVendorFree\WPDesk\Translation;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
class Translate
{
    const DEFAULT_LANG = 'en';
    /**
     * @var LoggerInterface
     */
    protected $logger;
    /**
     * @var string
     */
    protected $lang;
    /**
     * @var Resource[]
     */
    protected $data;
    /**
     * @param string $lang
     */
    public function __construct(string $lang)
    {
        $this->lang = $lang;
        $this->set_logger(new \Psr\Log\NullLogger());
    }
    /**
     * @param LoggerInterface $logger
     *
     * @return void
     */
    public function set_logger(\Psr\Log\LoggerInterface $logger) : void
    {
        $this->logger = $logger;
    }
    private function debug($message) : void
    {
        $this->logger->debug($message, ['resource' => 'wpdesk-translation']);
    }
    /**
     * @param string $file
     */
    public function add_resource_file(string $file) : void
    {
        if (\is_file($file)) {
            $contents = \file_get_contents($file);
            if ($contents === \false) {
                $this->debug('Unable to load file: ' . $file);
            } else {
                $this->add_resource_string($contents);
            }
        } else {
            $this->debug($file . ' does not exist');
        }
    }
    /**
     * @param string $resource
     */
    public function add_resource_string(string $resource) : void
    {
        $data = \json_decode($resource, \true);
        if (\json_last_error() !== \JSON_ERROR_NONE) {
            if (\function_exists('json_last_error_msg')) {
                $this->debug(\json_last_error_msg());
            }
            $this->debug('Error parsing JSON: ' . \json_last_error());
        } else {
            $this->add_resource_array($data);
        }
    }
    /**
     * @param array $resource The resource array
     */
    public function add_resource_array(array $resource) : void
    {
        foreach ($resource as $locale => $value) {
            $this->add_subresource($value, $locale);
        }
    }
    /**
     * Adds a sub-resource
     *
     * @param array  $subresource The sub-resource value
     * @param string $locale
     */
    private function add_subresource(array $subresource, string $locale) : void
    {
        $resource = new \WDFQVendorFree\WPDesk\Translation\Resource($locale, $subresource);
        if (isset($this->data[$locale])) {
            $this->data[$locale]->merge($resource);
        } else {
            $this->data[$locale] = $resource;
        }
    }
    /**
     * @param string      $key
     * @param string|null $lang
     *
     * @return string
     */
    public function __(string $key, ?string $lang = null) : string
    {
        if ($lang === null) {
            $lang = $this->lang;
        }
        if (!isset($this->data[$lang][$key])) {
            if (isset($this->data[self::DEFAULT_LANG][$key])) {
                return $this->data[self::DEFAULT_LANG][$key];
            }
            return $key;
        }
        return $this->data[$lang][$key];
    }
    /**
     * Prints localized text
     *
     * @param string      $key
     * @param string|null $lang
     */
    public function _e(string $key, ?string $lang = null) : void
    {
        echo $this->__($key, $lang);
    }
}
