<?php

declare (strict_types=1);
namespace WDFQVendorFree\Doctrine\Inflector\Rules\English;

use WDFQVendorFree\Doctrine\Inflector\GenericLanguageInflectorFactory;
use WDFQVendorFree\Doctrine\Inflector\Rules\Ruleset;
final class InflectorFactory extends \WDFQVendorFree\Doctrine\Inflector\GenericLanguageInflectorFactory
{
    protected function getSingularRuleset() : \WDFQVendorFree\Doctrine\Inflector\Rules\Ruleset
    {
        return \WDFQVendorFree\Doctrine\Inflector\Rules\English\Rules::getSingularRuleset();
    }
    protected function getPluralRuleset() : \WDFQVendorFree\Doctrine\Inflector\Rules\Ruleset
    {
        return \WDFQVendorFree\Doctrine\Inflector\Rules\English\Rules::getPluralRuleset();
    }
}