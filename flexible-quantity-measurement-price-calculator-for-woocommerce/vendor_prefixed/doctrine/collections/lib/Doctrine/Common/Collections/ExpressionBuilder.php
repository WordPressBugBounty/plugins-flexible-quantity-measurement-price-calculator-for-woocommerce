<?php

namespace WDFQVendorFree\Doctrine\Common\Collections;

use WDFQVendorFree\Doctrine\Common\Collections\Expr\Comparison;
use WDFQVendorFree\Doctrine\Common\Collections\Expr\CompositeExpression;
use WDFQVendorFree\Doctrine\Common\Collections\Expr\Value;
use function func_get_args;
/**
 * Builder for Expressions in the {@link Selectable} interface.
 *
 * Important Notice for interoperable code: You have to use scalar
 * values only for comparisons, otherwise the behavior of the comparison
 * may be different between implementations (Array vs ORM vs ODM).
 */
class ExpressionBuilder
{
    /**
     * @param mixed ...$x
     *
     * @return CompositeExpression
     */
    public function andX($x = null)
    {
        return new \WDFQVendorFree\Doctrine\Common\Collections\Expr\CompositeExpression(\WDFQVendorFree\Doctrine\Common\Collections\Expr\CompositeExpression::TYPE_AND, \func_get_args());
    }
    /**
     * @param mixed ...$x
     *
     * @return CompositeExpression
     */
    public function orX($x = null)
    {
        return new \WDFQVendorFree\Doctrine\Common\Collections\Expr\CompositeExpression(\WDFQVendorFree\Doctrine\Common\Collections\Expr\CompositeExpression::TYPE_OR, \func_get_args());
    }
    /**
     * @param string $field
     * @param mixed  $value
     *
     * @return Comparison
     */
    public function eq($field, $value)
    {
        return new \WDFQVendorFree\Doctrine\Common\Collections\Expr\Comparison($field, \WDFQVendorFree\Doctrine\Common\Collections\Expr\Comparison::EQ, new \WDFQVendorFree\Doctrine\Common\Collections\Expr\Value($value));
    }
    /**
     * @param string $field
     * @param mixed  $value
     *
     * @return Comparison
     */
    public function gt($field, $value)
    {
        return new \WDFQVendorFree\Doctrine\Common\Collections\Expr\Comparison($field, \WDFQVendorFree\Doctrine\Common\Collections\Expr\Comparison::GT, new \WDFQVendorFree\Doctrine\Common\Collections\Expr\Value($value));
    }
    /**
     * @param string $field
     * @param mixed  $value
     *
     * @return Comparison
     */
    public function lt($field, $value)
    {
        return new \WDFQVendorFree\Doctrine\Common\Collections\Expr\Comparison($field, \WDFQVendorFree\Doctrine\Common\Collections\Expr\Comparison::LT, new \WDFQVendorFree\Doctrine\Common\Collections\Expr\Value($value));
    }
    /**
     * @param string $field
     * @param mixed  $value
     *
     * @return Comparison
     */
    public function gte($field, $value)
    {
        return new \WDFQVendorFree\Doctrine\Common\Collections\Expr\Comparison($field, \WDFQVendorFree\Doctrine\Common\Collections\Expr\Comparison::GTE, new \WDFQVendorFree\Doctrine\Common\Collections\Expr\Value($value));
    }
    /**
     * @param string $field
     * @param mixed  $value
     *
     * @return Comparison
     */
    public function lte($field, $value)
    {
        return new \WDFQVendorFree\Doctrine\Common\Collections\Expr\Comparison($field, \WDFQVendorFree\Doctrine\Common\Collections\Expr\Comparison::LTE, new \WDFQVendorFree\Doctrine\Common\Collections\Expr\Value($value));
    }
    /**
     * @param string $field
     * @param mixed  $value
     *
     * @return Comparison
     */
    public function neq($field, $value)
    {
        return new \WDFQVendorFree\Doctrine\Common\Collections\Expr\Comparison($field, \WDFQVendorFree\Doctrine\Common\Collections\Expr\Comparison::NEQ, new \WDFQVendorFree\Doctrine\Common\Collections\Expr\Value($value));
    }
    /**
     * @param string $field
     *
     * @return Comparison
     */
    public function isNull($field)
    {
        return new \WDFQVendorFree\Doctrine\Common\Collections\Expr\Comparison($field, \WDFQVendorFree\Doctrine\Common\Collections\Expr\Comparison::EQ, new \WDFQVendorFree\Doctrine\Common\Collections\Expr\Value(null));
    }
    /**
     * @param string  $field
     * @param mixed[] $values
     *
     * @return Comparison
     */
    public function in($field, array $values)
    {
        return new \WDFQVendorFree\Doctrine\Common\Collections\Expr\Comparison($field, \WDFQVendorFree\Doctrine\Common\Collections\Expr\Comparison::IN, new \WDFQVendorFree\Doctrine\Common\Collections\Expr\Value($values));
    }
    /**
     * @param string  $field
     * @param mixed[] $values
     *
     * @return Comparison
     */
    public function notIn($field, array $values)
    {
        return new \WDFQVendorFree\Doctrine\Common\Collections\Expr\Comparison($field, \WDFQVendorFree\Doctrine\Common\Collections\Expr\Comparison::NIN, new \WDFQVendorFree\Doctrine\Common\Collections\Expr\Value($values));
    }
    /**
     * @param string $field
     * @param mixed  $value
     *
     * @return Comparison
     */
    public function contains($field, $value)
    {
        return new \WDFQVendorFree\Doctrine\Common\Collections\Expr\Comparison($field, \WDFQVendorFree\Doctrine\Common\Collections\Expr\Comparison::CONTAINS, new \WDFQVendorFree\Doctrine\Common\Collections\Expr\Value($value));
    }
    /**
     * @param string $field
     * @param mixed  $value
     *
     * @return Comparison
     */
    public function memberOf($field, $value)
    {
        return new \WDFQVendorFree\Doctrine\Common\Collections\Expr\Comparison($field, \WDFQVendorFree\Doctrine\Common\Collections\Expr\Comparison::MEMBER_OF, new \WDFQVendorFree\Doctrine\Common\Collections\Expr\Value($value));
    }
    /**
     * @param string $field
     * @param mixed  $value
     *
     * @return Comparison
     */
    public function startsWith($field, $value)
    {
        return new \WDFQVendorFree\Doctrine\Common\Collections\Expr\Comparison($field, \WDFQVendorFree\Doctrine\Common\Collections\Expr\Comparison::STARTS_WITH, new \WDFQVendorFree\Doctrine\Common\Collections\Expr\Value($value));
    }
    /**
     * @param string $field
     * @param mixed  $value
     *
     * @return Comparison
     */
    public function endsWith($field, $value)
    {
        return new \WDFQVendorFree\Doctrine\Common\Collections\Expr\Comparison($field, \WDFQVendorFree\Doctrine\Common\Collections\Expr\Comparison::ENDS_WITH, new \WDFQVendorFree\Doctrine\Common\Collections\Expr\Value($value));
    }
}
