<?php

declare (strict_types=1);
namespace WDFQVendorFree\Doctrine\Inflector\Rules\English;

use WDFQVendorFree\Doctrine\Inflector\Rules\Patterns;
use WDFQVendorFree\Doctrine\Inflector\Rules\Ruleset;
use WDFQVendorFree\Doctrine\Inflector\Rules\Substitutions;
use WDFQVendorFree\Doctrine\Inflector\Rules\Transformations;
final class Rules
{
    public static function getSingularRuleset() : \WDFQVendorFree\Doctrine\Inflector\Rules\Ruleset
    {
        return new \WDFQVendorFree\Doctrine\Inflector\Rules\Ruleset(new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformations(...\WDFQVendorFree\Doctrine\Inflector\Rules\English\Inflectible::getSingular()), new \WDFQVendorFree\Doctrine\Inflector\Rules\Patterns(...\WDFQVendorFree\Doctrine\Inflector\Rules\English\Uninflected::getSingular()), (new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitutions(...\WDFQVendorFree\Doctrine\Inflector\Rules\English\Inflectible::getIrregular()))->getFlippedSubstitutions());
    }
    public static function getPluralRuleset() : \WDFQVendorFree\Doctrine\Inflector\Rules\Ruleset
    {
        return new \WDFQVendorFree\Doctrine\Inflector\Rules\Ruleset(new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformations(...\WDFQVendorFree\Doctrine\Inflector\Rules\English\Inflectible::getPlural()), new \WDFQVendorFree\Doctrine\Inflector\Rules\Patterns(...\WDFQVendorFree\Doctrine\Inflector\Rules\English\Uninflected::getPlural()), new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitutions(...\WDFQVendorFree\Doctrine\Inflector\Rules\English\Inflectible::getIrregular()));
    }
}
