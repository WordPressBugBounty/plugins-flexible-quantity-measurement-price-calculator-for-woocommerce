<?php

namespace WDFQVendorFree\Doctrine\Common\Collections\Expr;

/**
 * Expression for the {@link Selectable} interface.
 */
interface Expression
{
    /** @return mixed */
    public function visit(\WDFQVendorFree\Doctrine\Common\Collections\Expr\ExpressionVisitor $visitor);
}