<?php

declare (strict_types=1);
namespace WDFQVendorFree\Doctrine\Inflector\Rules;

use WDFQVendorFree\Doctrine\Inflector\WordInflector;
class Transformations implements \WDFQVendorFree\Doctrine\Inflector\WordInflector
{
    /** @var Transformation[] */
    private $transformations;
    public function __construct(\WDFQVendorFree\Doctrine\Inflector\Rules\Transformation ...$transformations)
    {
        $this->transformations = $transformations;
    }
    public function inflect(string $word) : string
    {
        foreach ($this->transformations as $transformation) {
            if ($transformation->getPattern()->matches($word)) {
                return $transformation->inflect($word);
            }
        }
        return $word;
    }
}
