<?php

declare (strict_types=1);
namespace WDFQVendorFree\Doctrine\Inflector\Rules\Spanish;

use WDFQVendorFree\Doctrine\Inflector\Rules\Pattern;
use WDFQVendorFree\Doctrine\Inflector\Rules\Substitution;
use WDFQVendorFree\Doctrine\Inflector\Rules\Transformation;
use WDFQVendorFree\Doctrine\Inflector\Rules\Word;
class Inflectible
{
    /** @return Transformation[] */
    public static function getSingular() : iterable
    {
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/ereses$/'), 'erés'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/iones$/'), 'ión'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/ces$/'), 'z'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/es$/'), ''));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/s$/'), ''));
    }
    /** @return Transformation[] */
    public static function getPlural() : iterable
    {
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/ú([sn])$/i'), 'WDFQVendorFree\\u\\1es'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/ó([sn])$/i'), 'WDFQVendorFree\\o\\1es'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/í([sn])$/i'), 'WDFQVendorFree\\i\\1es'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/é([sn])$/i'), 'WDFQVendorFree\\e\\1es'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/á([sn])$/i'), 'WDFQVendorFree\\a\\1es'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/z$/i'), 'ces'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/([aeiou]s)$/i'), '\\1'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/([^aeéiou])$/i'), '\\1es'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/$/'), 's'));
    }
    /** @return Substitution[] */
    public static function getIrregular() : iterable
    {
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('el'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('los')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('papá'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('papás')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('mamá'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('mamás')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('sofá'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('sofás')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('mes'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('meses')));
    }
}
