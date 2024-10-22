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
    public static function getSingular(): iterable
    {
        yield new Transformation(new Pattern('/l[ae]r$/i'), '');
    }
    /** @return Transformation[] */
    public static function getPlural(): iterable
    {
        yield new Transformation(new Pattern('/([eöiü][^aoıueöiü]{0,6})$/u'), '\1ler');
        yield new Transformation(new Pattern('/([aoıu][^aoıueöiü]{0,6})$/u'), '\1lar');
    }
    /** @return Substitution[] */
    public static function getIrregular(): iterable
    {
        yield new Substitution(new Word('ben'), new Word('biz'));
        yield new Substitution(new Word('sen'), new Word('siz'));
        yield new Substitution(new Word('o'), new Word('onlar'));
    }
}
