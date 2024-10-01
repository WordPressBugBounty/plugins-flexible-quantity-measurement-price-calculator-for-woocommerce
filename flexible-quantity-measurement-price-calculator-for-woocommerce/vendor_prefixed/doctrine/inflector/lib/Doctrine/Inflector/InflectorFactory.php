<?php

declare (strict_types=1);
namespace WDFQVendorFree\Doctrine\Inflector;

use WDFQVendorFree\Doctrine\Inflector\Rules\English;
use WDFQVendorFree\Doctrine\Inflector\Rules\French;
use WDFQVendorFree\Doctrine\Inflector\Rules\NorwegianBokmal;
use WDFQVendorFree\Doctrine\Inflector\Rules\Portuguese;
use WDFQVendorFree\Doctrine\Inflector\Rules\Spanish;
use WDFQVendorFree\Doctrine\Inflector\Rules\Turkish;
use InvalidArgumentException;
use function sprintf;
final class InflectorFactory
{
    public static function create() : \WDFQVendorFree\Doctrine\Inflector\LanguageInflectorFactory
    {
        return self::createForLanguage(\WDFQVendorFree\Doctrine\Inflector\Language::ENGLISH);
    }
    public static function createForLanguage(string $language) : \WDFQVendorFree\Doctrine\Inflector\LanguageInflectorFactory
    {
        switch ($language) {
            case \WDFQVendorFree\Doctrine\Inflector\Language::ENGLISH:
                return new \WDFQVendorFree\Doctrine\Inflector\Rules\English\InflectorFactory();
            case \WDFQVendorFree\Doctrine\Inflector\Language::FRENCH:
                return new \WDFQVendorFree\Doctrine\Inflector\Rules\French\InflectorFactory();
            case \WDFQVendorFree\Doctrine\Inflector\Language::NORWEGIAN_BOKMAL:
                return new \WDFQVendorFree\Doctrine\Inflector\Rules\NorwegianBokmal\InflectorFactory();
            case \WDFQVendorFree\Doctrine\Inflector\Language::PORTUGUESE:
                return new \WDFQVendorFree\Doctrine\Inflector\Rules\Portuguese\InflectorFactory();
            case \WDFQVendorFree\Doctrine\Inflector\Language::SPANISH:
                return new \WDFQVendorFree\Doctrine\Inflector\Rules\Spanish\InflectorFactory();
            case \WDFQVendorFree\Doctrine\Inflector\Language::TURKISH:
                return new \WDFQVendorFree\Doctrine\Inflector\Rules\Turkish\InflectorFactory();
            default:
                throw new \InvalidArgumentException(\sprintf('Language "%s" is not supported.', $language));
        }
    }
}
