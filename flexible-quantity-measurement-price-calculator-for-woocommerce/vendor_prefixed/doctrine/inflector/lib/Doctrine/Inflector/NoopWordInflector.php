<?php

declare (strict_types=1);
namespace WDFQVendorFree\Doctrine\Inflector;

class NoopWordInflector implements \WDFQVendorFree\Doctrine\Inflector\WordInflector
{
    public function inflect(string $word) : string
    {
        return $word;
    }
}
