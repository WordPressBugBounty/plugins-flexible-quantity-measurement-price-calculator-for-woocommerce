<?php

declare (strict_types=1);
namespace WDFQVendorFree\Doctrine\Inflector\Rules;

use WDFQVendorFree\Doctrine\Inflector\WordInflector;
use function preg_replace;
final class Transformation implements \WDFQVendorFree\Doctrine\Inflector\WordInflector
{
    /** @var Pattern */
    private $pattern;
    /** @var string */
    private $replacement;
    public function __construct(\WDFQVendorFree\Doctrine\Inflector\Rules\Pattern $pattern, string $replacement)
    {
        $this->pattern = $pattern;
        $this->replacement = $replacement;
    }
    public function getPattern() : \WDFQVendorFree\Doctrine\Inflector\Rules\Pattern
    {
        return $this->pattern;
    }
    public function getReplacement() : string
    {
        return $this->replacement;
    }
    public function inflect(string $word) : string
    {
        return (string) \preg_replace($this->pattern->getRegex(), $this->replacement, $word);
    }
}
