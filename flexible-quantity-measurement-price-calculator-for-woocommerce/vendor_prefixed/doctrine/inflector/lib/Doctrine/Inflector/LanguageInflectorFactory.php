<?php

declare (strict_types=1);
namespace WDFQVendorFree\Doctrine\Inflector;

use WDFQVendorFree\Doctrine\Inflector\Rules\Ruleset;
interface LanguageInflectorFactory
{
    /**
     * Applies custom rules for singularisation
     *
     * @param bool $reset If true, will unset default inflections for all new rules
     *
     * @return $this
     */
    public function withSingularRules(?\WDFQVendorFree\Doctrine\Inflector\Rules\Ruleset $singularRules, bool $reset = \false) : self;
    /**
     * Applies custom rules for pluralisation
     *
     * @param bool $reset If true, will unset default inflections for all new rules
     *
     * @return $this
     */
    public function withPluralRules(?\WDFQVendorFree\Doctrine\Inflector\Rules\Ruleset $pluralRules, bool $reset = \false) : self;
    /**
     * Builds the inflector instance with all applicable rules
     */
    public function build() : \WDFQVendorFree\Doctrine\Inflector\Inflector;
}
