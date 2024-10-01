<?php

declare (strict_types=1);
namespace WDFQVendorFree\Doctrine\Inflector\Rules;

final class Substitution
{
    /** @var Word */
    private $from;
    /** @var Word */
    private $to;
    public function __construct(\WDFQVendorFree\Doctrine\Inflector\Rules\Word $from, \WDFQVendorFree\Doctrine\Inflector\Rules\Word $to)
    {
        $this->from = $from;
        $this->to = $to;
    }
    public function getFrom() : \WDFQVendorFree\Doctrine\Inflector\Rules\Word
    {
        return $this->from;
    }
    public function getTo() : \WDFQVendorFree\Doctrine\Inflector\Rules\Word
    {
        return $this->to;
    }
}
