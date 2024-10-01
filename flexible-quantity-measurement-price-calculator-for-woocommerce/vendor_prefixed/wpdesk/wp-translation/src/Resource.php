<?php

namespace WDFQVendorFree\WPDesk\Translation;

use ArrayIterator;
class Resource implements \ArrayAccess, \Countable, \IteratorAggregate, \JsonSerializable
{
    /**
     * @var string[]
     */
    private $data = [];
    /**
     * @var string[]
     */
    private $locale;
    /**
     * @param string   $locale
     * @param string[] $data Translation data
     */
    public function __construct(string $locale, array $data = [])
    {
        $this->data = $data;
        $this->set_locale($locale);
    }
    /**
     * @param string $json
     *
     * @return \self
     */
    public function from_json(string $json) : self
    {
        $input = \json_decode($json, \true);
        $data = \reset($input);
        $locale = \key($input);
        return new self($locale, $data);
    }
    /**
     * @param string $locale
     *
     * @throws \InvalidArgumentException
     */
    private function set_locale(string $locale)
    {
        $arr = \Locale::parseLocale($locale);
        if ($arr === \false) {
            throw new \InvalidArgumentException('Invalid locale');
        }
        $this->locale = $arr;
    }
    /**
     * @return string
     */
    public function get_locale() : string
    {
        return \str_replace('_', '-', \Locale::composeLocale($this->locale));
    }
    /**
     * @param array   $data
     * @param boolean $overwrite
     */
    public function add_data(array $data, bool $overwrite = \true) : void
    {
        if ($overwrite) {
            $this->data = \array_merge($this->data, $data);
        } else {
            $this->data = \array_merge($data, $this->data);
        }
    }
    public function merge(self $resource, bool $overwrite = \true) : void
    {
        if ($this->get_locale() !== $resource->get_locale()) {
            \trigger_error('Attempting to merge resources of different locale', \E_USER_NOTICE);
        }
        $this->add_data($resource->data, $overwrite);
    }
    /**
     * @return int
     */
    public function count() : int
    {
        return \sizeof($this->data);
    }
    public function getIterator() : \ArrayIterator
    {
        return new \ArrayIterator($this->data);
    }
    public function offsetExists($offset) : bool
    {
        return isset($this->data[$offset]);
    }
    public function offsetGet($offset) : string
    {
        return $this->data[$offset];
    }
    public function offsetSet($offset, $value) : void
    {
        $this->data[$offset] = $value;
    }
    public function offsetUnset($offset) : void
    {
        unset($this->data[$offset]);
    }
    /**
     * @return string
     */
    public function jsonSerialize() : string
    {
        $output = [$this->get_locale() => $this->data];
        return \json_encode($output, \JSON_HEX_AMP | \JSON_HEX_APOS | \JSON_HEX_QUOT | \JSON_HEX_TAG);
    }
}
