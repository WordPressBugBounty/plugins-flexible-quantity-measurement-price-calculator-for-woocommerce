<?php

declare (strict_types=1);
namespace WDFQVendorFree\Doctrine\Inflector\Rules\Turkish;

use WDFQVendorFree\Doctrine\Inflector\Rules\Pattern;
final class Uninflected
{
    /** @return Pattern[] */
    public static function getSingular() : iterable
    {
        yield from self::getDefault();
    }
    /** @return Pattern[] */
    public static function getPlural() : iterable
    {
        yield from self::getDefault();
    }
    /** @return Pattern[] */
    private static function getDefault() : iterable
    {
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('lunes'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('rompecabezas'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('crisis'));
    }
}