<?php

declare (strict_types=1);
namespace WDFQVendorFree\Doctrine\Inflector\Rules\Turkish;

use WDFQVendorFree\Doctrine\Inflector\Rules\Pattern;
use WDFQVendorFree\Doctrine\Inflector\Rules\Substitution;
use WDFQVendorFree\Doctrine\Inflector\Rules\Transformation;
use WDFQVendorFree\Doctrine\Inflector\Rules\Word;
class Inflectible
{
    /** @return Transformation[] */
    public static function getSingular() : iterable
    {
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/l[ae]r$/i'), ''));
    }
    /** @return Transformation[] */
    public static function getPlural() : iterable
    {
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/([eöiü][^aoıueöiü]{0,6})$/u'), '\\1ler'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/([aoıu][^aoıueöiü]{0,6})$/u'), '\\1lar'));
    }
    /** @return Substitution[] */
    public static function getIrregular() : iterable
    {
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('ben'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('biz')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('sen'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('siz')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('o'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('onlar')));
    }
}
