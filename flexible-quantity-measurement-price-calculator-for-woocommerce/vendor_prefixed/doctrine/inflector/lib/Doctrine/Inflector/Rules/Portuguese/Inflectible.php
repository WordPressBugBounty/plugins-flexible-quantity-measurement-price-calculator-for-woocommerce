<?php

declare (strict_types=1);
namespace WDFQVendorFree\Doctrine\Inflector\Rules\Portuguese;

use WDFQVendorFree\Doctrine\Inflector\Rules\Pattern;
use WDFQVendorFree\Doctrine\Inflector\Rules\Substitution;
use WDFQVendorFree\Doctrine\Inflector\Rules\Transformation;
use WDFQVendorFree\Doctrine\Inflector\Rules\Word;
class Inflectible
{
    /** @return Transformation[] */
    public static function getSingular() : iterable
    {
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/^(g|)ases$/i'), '\\1ás'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/(japon|escoc|ingl|dinamarqu|fregu|portugu)eses$/i'), '\\1ês'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/(ae|ao|oe)s$/'), 'ao'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/(ãe|ão|õe)s$/'), 'ão'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/^(.*[^s]s)es$/i'), '\\1'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/sses$/i'), 'sse'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/ns$/i'), 'm'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/(r|t|f|v)is$/i'), '\\1il'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/uis$/i'), 'ul'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/ois$/i'), 'ol'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/eis$/i'), 'ei'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/éis$/i'), 'el'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/([^p])ais$/i'), '\\1al'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/(r|z)es$/i'), '\\1'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/^(á|gá)s$/i'), '\\1s'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/([^ê])s$/i'), '\\1'));
    }
    /** @return Transformation[] */
    public static function getPlural() : iterable
    {
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/^(alem|c|p)ao$/i'), '\\1aes'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/^(irm|m)ao$/i'), '\\1aos'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/ao$/i'), 'oes'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/^(alem|c|p)ão$/i'), '\\1ães'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/^(irm|m)ão$/i'), '\\1ãos'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/ão$/i'), 'ões'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/^(|g)ás$/i'), '\\1ases'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/^(japon|escoc|ingl|dinamarqu|fregu|portugu)ês$/i'), '\\1eses'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/m$/i'), 'ns'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/([^aeou])il$/i'), '\\1is'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/ul$/i'), 'uis'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/ol$/i'), 'ois'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/el$/i'), 'eis'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/al$/i'), 'ais'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/(z|r)$/i'), '\\1es'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/(s)$/i'), '\\1'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('/$/'), 's'));
    }
    /** @return Substitution[] */
    public static function getIrregular() : iterable
    {
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('abdomen'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('abdomens')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('alemão'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('alemães')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('artesã'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('artesãos')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('álcool'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('álcoois')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('árvore'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('árvores')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('bencão'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('bencãos')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('cão'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('cães')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('campus'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('campi')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('cadáver'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('cadáveres')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('capelão'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('capelães')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('capitão'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('capitães')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('chão'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('chãos')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('charlatão'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('charlatães')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('cidadão'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('cidadãos')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('consul'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('consules')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('cristão'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('cristãos')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('difícil'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('difíceis')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('email'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('emails')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('escrivão'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('escrivães')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('fóssil'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('fósseis')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('gás'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('gases')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('germens'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('germen')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('grão'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('grãos')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('hífen'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('hífens')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('irmão'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('irmãos')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('liquens'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('liquen')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('mal'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('males')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('mão'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('mãos')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('orfão'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('orfãos')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('país'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('países')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('pai'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('pais')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('pão'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('pães')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('projétil'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('projéteis')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('réptil'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('répteis')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('sacristão'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('sacristães')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('sotão'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('sotãos')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('tabelião'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('tabeliães')));
    }
}
