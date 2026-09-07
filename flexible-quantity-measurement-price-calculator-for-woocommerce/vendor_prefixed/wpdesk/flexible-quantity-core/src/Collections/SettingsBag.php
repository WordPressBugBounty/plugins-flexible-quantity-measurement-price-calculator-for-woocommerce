<?php

namespace WDFQVendorFree\WPDesk\Library\FlexibleQuantityCore\Collections;

use WDFQVendorFree\Doctrine\Common\Collections\ArrayCollection;
/**
 * Route Parameters as collection.
 *
 * @template TKey of string
 * @template T
 * @extends ArrayCollection<TKey, T>
 */
class SettingsBag extends ArrayCollection
{
    /**
     * Returns the nested array as collection.
     *
     * @param string $key
     *
     * @return SettingsBag<TKey, T>
     */
    public function bag(string $key): SettingsBag
    {
        if (!is_array($this->get($key))) {
            return new static();
        }
        return new static($this->get($key));
    }
    /**
     * Returns the parameter as string.
     *
     * @param string $key
     *
     * @return string
     */
    public function getString(string $key, string $default = ''): string
    {
        $value = $this->get($key);
        if (!\is_scalar($value) && !$value instanceof \Stringable) {
            return $default;
        }
        return (string) $value;
    }
    /**
     * Returns the parameter as float.
     *
     * @param string $key
     *
     * @return float
     */
    public function getFloat(string $key, float $default = 0): float
    {
        $value = $this->get($key);
        if (!\is_numeric($value)) {
            return $default;
        }
        return (float) $value;
    }
}
