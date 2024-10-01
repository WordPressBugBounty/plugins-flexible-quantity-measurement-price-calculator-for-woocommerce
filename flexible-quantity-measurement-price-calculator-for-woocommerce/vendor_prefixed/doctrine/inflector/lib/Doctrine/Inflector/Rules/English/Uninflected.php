<?php

declare (strict_types=1);
namespace WDFQVendorFree\Doctrine\Inflector\Rules\English;

use WDFQVendorFree\Doctrine\Inflector\Rules\Pattern;
final class Uninflected
{
    /** @return Pattern[] */
    public static function getSingular() : iterable
    {
        yield from self::getDefault();
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('.*ss'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('clothes'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('data'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('fascia'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('fuchsia'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('galleria'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('mafia'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('militia'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('pants'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('petunia'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('sepia'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('trivia'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('utopia'));
    }
    /** @return Pattern[] */
    public static function getPlural() : iterable
    {
        yield from self::getDefault();
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('people'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('trivia'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('\\w+ware$'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('media'));
    }
    /** @return Pattern[] */
    private static function getDefault() : iterable
    {
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('\\w+media'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('advice'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('aircraft'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('amoyese'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('art'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('audio'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('baggage'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('bison'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('borghese'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('bream'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('breeches'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('britches'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('buffalo'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('butter'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('cantus'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('carp'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('cattle'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('chassis'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('clippers'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('clothing'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('coal'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('cod'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('coitus'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('compensation'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('congoese'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('contretemps'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('coreopsis'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('corps'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('cotton'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('data'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('debris'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('deer'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('diabetes'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('djinn'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('education'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('eland'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('elk'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('emoji'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('equipment'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('evidence'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('faroese'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('feedback'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('fish'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('flounder'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('flour'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('foochowese'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('food'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('furniture'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('gallows'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('genevese'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('genoese'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('gilbertese'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('gold'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('headquarters'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('herpes'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('hijinks'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('homework'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('hottentotese'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('impatience'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('information'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('innings'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('jackanapes'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('jeans'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('jedi'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('kin'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('kiplingese'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('knowledge'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('kongoese'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('leather'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('love'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('lucchese'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('luggage'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('mackerel'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('Maltese'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('management'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('metadata'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('mews'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('money'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('moose'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('mumps'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('music'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('nankingese'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('news'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('nexus'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('niasese'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('nutrition'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('offspring'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('oil'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('patience'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('pekingese'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('piedmontese'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('pincers'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('pistoiese'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('plankton'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('pliers'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('pokemon'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('police'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('polish'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('portuguese'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('proceedings'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('progress'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('rabies'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('rain'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('research'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('rhinoceros'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('rice'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('salmon'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('sand'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('sarawakese'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('scissors'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('sea[- ]bass'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('series'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('shavese'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('shears'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('sheep'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('siemens'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('silk'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('sms'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('soap'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('social media'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('spam'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('species'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('staff'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('sugar'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('swine'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('talent'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('toothpaste'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('traffic'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('travel'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('trousers'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('trout'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('tuna'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('us'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('vermontese'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('vinegar'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('weather'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('wenchowese'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('wheat'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('whiting'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('wildebeest'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('wood'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('wool'));
        (yield new \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern('yengeese'));
    }
}
