<?php

declare (strict_types=1);
namespace WDFQVendorFree\Doctrine\Inflector;

interface WordInflector
{
    public function inflect(string $word): string;
}
