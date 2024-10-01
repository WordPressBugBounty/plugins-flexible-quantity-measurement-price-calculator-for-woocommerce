<?php

declare (strict_types=1);
namespace WDFQVendorFree\Doctrine\Inflector\Rules\English;

use WDFQVendorFree\Doctrine\Inflector\Rules\Pattern;
use WDFQVendorFree\Doctrine\Inflector\Rules\Substitution;
use WDFQVendorFree\Doctrine\Inflector\Rules\Transformation;
use WDFQVendorFree\Doctrine\Inflector\Rules\Word;
class Inflectible
{
    /** @return Transformation[] */
    public static function getSingular() : iterable
    {
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(s)tatuses$'), 'WDFQVendorFree\\1\\2tatus'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(s)tatus$'), 'WDFQVendorFree\\1\\2tatus'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(c)ampus$'), 'WDFQVendorFree\\1\\2ampus'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('^(.*)(menu)s$'), 'WDFQVendorFree\\1\\2'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(quiz)zes$'), '\\1'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(matr)ices$'), '\\1ix'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(vert|ind)ices$'), '\\1ex'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('^(ox)en'), '\\1'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(alias)(es)*$'), '\\1'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(buffal|her|potat|tomat|volcan)oes$'), '\\1o'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(alumn|bacill|cact|foc|fung|nucle|radi|stimul|syllab|termin|viri?)i$'), '\\1us'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('([ftw]ax)es'), '\\1'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(analys|ax|cris|test|thes)es$'), '\\1is'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(shoe|slave)s$'), '\\1'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(o)es$'), '\\1'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('ouses$'), 'ouse'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('([^a])uses$'), '\\1us'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('([m|l])ice$'), '\\1ouse'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(x|ch|ss|sh)es$'), '\\1'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(m)ovies$'), 'WDFQVendorFree\\1\\2ovie'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(s)eries$'), 'WDFQVendorFree\\1\\2eries'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('([^aeiouy]|qu)ies$'), '\\1y'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('([lr])ves$'), '\\1f'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(tive)s$'), '\\1'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(hive)s$'), '\\1'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(drive)s$'), '\\1'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(dive)s$'), '\\1'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(olive)s$'), '\\1'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('([^fo])ves$'), '\\1fe'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(^analy)ses$'), '\\1sis'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(analy|diagno|^ba|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$'), 'WDFQVendorFree\\1\\2sis'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(tax)a$'), '\\1on'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(c)riteria$'), '\\1riterion'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('([ti])a(?<!regatta)$'), '\\1um'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(p)eople$'), 'WDFQVendorFree\\1\\2erson'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(m)en$'), '\\1an'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(c)hildren$'), 'WDFQVendorFree\\1\\2hild'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(f)eet$'), '\\1oot'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(n)ews$'), 'WDFQVendorFree\\1\\2ews'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('eaus$'), 'eau'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('^tights$'), 'tights'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('^shorts$'), 'shorts'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('s$'), ''));
    }
    /** @return Transformation[] */
    public static function getPlural() : iterable
    {
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(s)tatus$'), 'WDFQVendorFree\\1\\2tatuses'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(quiz)$'), '\\1zes'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('^(ox)$'), 'WDFQVendorFree\\1\\2en'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('([m|l])ouse$'), '\\1ice'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(matr|vert|ind)(ix|ex)$'), '\\1ices'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(x|ch|ss|sh)$'), '\\1es'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('([^aeiouy]|qu)y$'), '\\1ies'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(hive|gulf)$'), '\\1s'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(?:([^f])fe|([lr])f)$'), 'WDFQVendorFree\\1\\2ves'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('sis$'), 'ses'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('([ti])um$'), '\\1a'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(tax)on$'), '\\1a'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(c)riterion$'), '\\1riteria'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(p)erson$'), '\\1eople'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(m)an$'), '\\1en'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(c)hild$'), '\\1hildren'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(f)oot$'), '\\1eet'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(buffal|her|potat|tomat|volcan)o$'), 'WDFQVendorFree\\1\\2oes'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(alumn|bacill|cact|foc|fung|nucle|radi|stimul|syllab|termin|vir)us$'), '\\1i'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('us$'), 'uses'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(alias)$'), '\\1es'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('(analys|ax|cris|test|thes)is$'), '\\1es'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('s$'), 's'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('^$'), ''));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Transformation(new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('$'), 's'));
    }
    /** @return Substitution[] */
    public static function getIrregular() : iterable
    {
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('atlas'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('atlases')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('axis'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('axes')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('axe'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('axes')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('beef'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('beefs')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('blouse'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('blouses')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('brother'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('brothers')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('cafe'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('cafes')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('cave'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('caves')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('chateau'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('chateaux')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('niveau'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('niveaux')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('child'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('children')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('canvas'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('canvases')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('cookie'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('cookies')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('brownie'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('brownies')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('corpus'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('corpuses')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('cow'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('cows')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('criterion'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('criteria')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('curriculum'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('curricula')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('demo'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('demos')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('domino'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('dominoes')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('echo'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('echoes')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('epoch'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('epochs')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('foot'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('feet')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('fungus'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('fungi')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('ganglion'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('ganglions')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('gas'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('gases')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('genie'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('genies')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('genus'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('genera')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('goose'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('geese')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('graffito'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('graffiti')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('hippopotamus'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('hippopotami')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('hoof'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('hoofs')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('human'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('humans')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('iris'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('irises')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('larva'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('larvae')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('leaf'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('leaves')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('lens'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('lenses')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('loaf'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('loaves')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('man'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('men')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('medium'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('media')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('memorandum'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('memoranda')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('money'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('monies')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('mongoose'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('mongooses')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('motto'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('mottoes')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('move'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('moves')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('mythos'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('mythoi')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('niche'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('niches')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('nucleus'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('nuclei')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('numen'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('numina')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('occiput'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('occiputs')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('octopus'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('octopuses')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('opus'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('opuses')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('ox'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('oxen')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('passerby'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('passersby')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('penis'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('penises')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('person'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('people')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('plateau'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('plateaux')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('runner-up'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('runners-up')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('safe'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('safes')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('sex'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('sexes')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('sieve'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('sieves')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('soliloquy'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('soliloquies')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('son-in-law'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('sons-in-law')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('syllabus'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('syllabi')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('testis'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('testes')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('thief'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('thieves')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('tooth'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('teeth')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('tornado'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('tornadoes')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('trilby'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('trilbys')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('turf'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('turfs')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('valve'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('valves')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('volcano'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('volcanoes')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('abuse'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('abuses')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('avalanche'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('avalanches')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('cache'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('caches')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('criterion'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('criteria')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('curve'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('curves')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('emphasis'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('emphases')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('foe'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('foes')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('grave'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('graves')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('hoax'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('hoaxes')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('medium'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('media')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('neurosis'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('neuroses')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('save'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('saves')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('wave'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('waves')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('oasis'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('oases')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('valve'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('valves')));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Substitution(new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('zombie'), new \WDFQVendorFree\Doctrine\Inflector\Rules\Word('zombies')));
    }
}
