<?php

declare (strict_types=1);
namespace WDFQVendorFree\Doctrine\Inflector\Rules\English;

use WDFQVendorFree\Doctrine\Inflector\GenericLanguageInflectorFactory;
use WDFQVendorFree\Doctrine\Inflector\Rules\Ruleset;
final class InflectorFactory extends GenericLanguageInflectorFactory
{
    protected function getSingularRuleset(): Ruleset
    {
        return Rules::getSingularRuleset();
    }
    protected function getPluralRuleset(): Ruleset
    {
        return Rules::getPluralRuleset();
    }
}
