<?php

declare (strict_types=1);
namespace WDFQVendorFree\Doctrine\Inflector\Rules;

class Ruleset
{
    /** @var Transformations */
    private $regular;
    /** @var Patterns */
    private $uninflected;
    /** @var Substitutions */
    private $irregular;
    public function __construct(\WDFQVendorFree\Doctrine\Inflector\Rules\Transformations $regular, \WDFQVendorFree\Doctrine\Inflector\Rules\Patterns $uninflected, \WDFQVendorFree\Doctrine\Inflector\Rules\Substitutions $irregular)
    {
        $this->regular = $regular;
        $this->uninflected = $uninflected;
        $this->irregular = $irregular;
    }
    public function getRegular() : \WDFQVendorFree\Doctrine\Inflector\Rules\Transformations
    {
        return $this->regular;
    }
    public function getUninflected() : \WDFQVendorFree\Doctrine\Inflector\Rules\Patterns
    {
        return $this->uninflected;
    }
    public function getIrregular() : \WDFQVendorFree\Doctrine\Inflector\Rules\Substitutions
    {
        return $this->irregular;
    }
}
