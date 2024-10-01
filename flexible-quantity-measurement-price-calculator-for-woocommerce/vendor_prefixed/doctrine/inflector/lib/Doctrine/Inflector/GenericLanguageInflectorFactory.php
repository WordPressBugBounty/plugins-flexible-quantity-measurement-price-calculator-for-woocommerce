<?php

declare (strict_types=1);
namespace WDFQVendorFree\Doctrine\Inflector;

use WDFQVendorFree\Doctrine\Inflector\Rules\Ruleset;
use function array_unshift;
abstract class GenericLanguageInflectorFactory implements \WDFQVendorFree\Doctrine\Inflector\LanguageInflectorFactory
{
    /** @var Ruleset[] */
    private $singularRulesets = [];
    /** @var Ruleset[] */
    private $pluralRulesets = [];
    public final function __construct()
    {
        $this->singularRulesets[] = $this->getSingularRuleset();
        $this->pluralRulesets[] = $this->getPluralRuleset();
    }
    public final function build() : \WDFQVendorFree\Doctrine\Inflector\Inflector
    {
        return new \WDFQVendorFree\Doctrine\Inflector\Inflector(new \WDFQVendorFree\Doctrine\Inflector\CachedWordInflector(new \WDFQVendorFree\Doctrine\Inflector\RulesetInflector(...$this->singularRulesets)), new \WDFQVendorFree\Doctrine\Inflector\CachedWordInflector(new \WDFQVendorFree\Doctrine\Inflector\RulesetInflector(...$this->pluralRulesets)));
    }
    public final function withSingularRules(?\WDFQVendorFree\Doctrine\Inflector\Rules\Ruleset $singularRules, bool $reset = \false) : \WDFQVendorFree\Doctrine\Inflector\LanguageInflectorFactory
    {
        if ($reset) {
            $this->singularRulesets = [];
        }
        if ($singularRules instanceof \WDFQVendorFree\Doctrine\Inflector\Rules\Ruleset) {
            \array_unshift($this->singularRulesets, $singularRules);
        }
        return $this;
    }
    public final function withPluralRules(?\WDFQVendorFree\Doctrine\Inflector\Rules\Ruleset $pluralRules, bool $reset = \false) : \WDFQVendorFree\Doctrine\Inflector\LanguageInflectorFactory
    {
        if ($reset) {
            $this->pluralRulesets = [];
        }
        if ($pluralRules instanceof \WDFQVendorFree\Doctrine\Inflector\Rules\Ruleset) {
            \array_unshift($this->pluralRulesets, $pluralRules);
        }
        return $this;
    }
    protected abstract function getSingularRuleset() : \WDFQVendorFree\Doctrine\Inflector\Rules\Ruleset;
    protected abstract function getPluralRuleset() : \WDFQVendorFree\Doctrine\Inflector\Rules\Ruleset;
}
