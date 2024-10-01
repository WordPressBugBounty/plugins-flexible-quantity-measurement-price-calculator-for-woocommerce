<?php

declare (strict_types=1);
namespace WDFQVendorFree\Doctrine\Inflector\Rules\French;

use WDFQVendorFree\Doctrine\Inflector\Rules\Pattern;
use WDFQVendorFree\Doctrine\Inflector\Rules\Substitution;
use WDFQVendorFree\Doctrine\Inflector\Rules\Transformation;
use WDFQVendorFree\Doctrine\Inflector\Rules\Word;
class Inflectible
{
    /** @return Transformation[] */
    public static function getSingular() : iterable
    {
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/(b|cor|ém|gemm|soupir|trav|vant|vitr)aux$/'), '\\1ail'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/ails$/'), 'ail'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/(journ|chev)aux$/'), '\\1al'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/(bijou|caillou|chou|genou|hibou|joujou|pou|au|eu|eau)x$/'), '\\1'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/s$/'), ''));
    }
    /** @return Transformation[] */
    public static function getPlural() : iterable
    {
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/(s|x|z)$/'), '\\1'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/(b|cor|ém|gemm|soupir|trav|vant|vitr)ail$/'), '\\1aux'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/ail$/'), 'ails'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/(chacal|carnaval|festival|récital)$/'), '\\1s'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/al$/'), 'aux'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/(bleu|émeu|landau|pneu|sarrau)$/'), '\\1s'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/(bijou|caillou|chou|genou|hibou|joujou|lieu|pou|au|eu|eau)$/'), '\\1x'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/$/'), 's'));
    }
    /** @return Substitution[] */
    public static function getIrregular() : iterable
    {
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('monsieur'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('messieurs')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('madame'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('mesdames')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('mademoiselle'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('mesdemoiselles')));
    }
}
