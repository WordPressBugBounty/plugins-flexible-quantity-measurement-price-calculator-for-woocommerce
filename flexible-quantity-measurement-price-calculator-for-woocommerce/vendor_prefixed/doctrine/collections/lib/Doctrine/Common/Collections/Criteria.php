<?php

namespace WDFQVendorFree\Doctrine\Common\Collections;

use WDFQVendorFree\Doctrine\Common\Collections\Expr\CompositeExpression;
use WDFQVendorFree\Doctrine\Common\Collections\Expr\Expression;
use WDFQVendorFree\Doctrine\Deprecations\Deprecation;
use function array_map;
use function func_num_args;
use function strtoupper;
/**
 * Criteria for filtering Selectable collections.
 *
 * @psalm-consistent-constructor
 */
class Criteria
{
    public const ASC = 'ASC';
    public const DESC = 'DESC';
    /** @var ExpressionBuilder|null */
    private static $expressionBuilder;
    /** @var Expression|null */
    private $expression;
    /** @var string[] */
    private $orderings = [];
    /** @var int|null */
    private $firstResult;
    /** @var int|null */
    private $maxResults;
    /**
     * Creates an instance of the class.
     *
     * @return Criteria
     */
    public static function create()
    {
        return new static();
    }
    /**
     * Returns the expression builder.
     *
     * @return ExpressionBuilder
     */
    public static function expr()
    {
        if (self::$expressionBuilder === null) {
            self::$expressionBuilder = new \WDFQVendorFree\Doctrine\Common\Collections\ExpressionBuilder();
        }
        return self::$expressionBuilder;
    }
    /**
     * Construct a new Criteria.
     *
     * @param string[]|null $orderings
     * @param int|null      $firstResult
     * @param int|null      $maxResults
     */
    public function __construct(?\WDFQVendorFree\Doctrine\Common\Collections\Expr\Expression $expression = null, ?array $orderings = null, $firstResult = null, $maxResults = null)
    {
        $this->expression = $expression;
        if ($firstResult === null && \func_num_args() > 2) {
            \WDFQVendorFree\Doctrine\Deprecations\Deprecation::trigger('doctrine/collections', 'https://github.com/doctrine/collections/pull/311', 'Passing null as $firstResult to the constructor of %s is deprecated. Pass 0 instead or omit the argument.', self::class);
        }
        $this->setFirstResult($firstResult);
        $this->setMaxResults($maxResults);
        if ($orderings === null) {
            return;
        }
        $this->orderBy($orderings);
    }
    /**
     * Sets the where expression to evaluate when this Criteria is searched for.
     *
     * @return $this
     */
    public function where(\WDFQVendorFree\Doctrine\Common\Collections\Expr\Expression $expression)
    {
        $this->expression = $expression;
        return $this;
    }
    /**
     * Appends the where expression to evaluate when this Criteria is searched for
     * using an AND with previous expression.
     *
     * @return $this
     */
    public function andWhere(\WDFQVendorFree\Doctrine\Common\Collections\Expr\Expression $expression)
    {
        if ($this->expression === null) {
            return $this->where($expression);
        }
        $this->expression = new \WDFQVendorFree\Doctrine\Common\Collections\Expr\CompositeExpression(\WDFQVendorFree\Doctrine\Common\Collections\Expr\CompositeExpression::TYPE_AND, [$this->expression, $expression]);
        return $this;
    }
    /**
     * Appends the where expression to evaluate when this Criteria is searched for
     * using an OR with previous expression.
     *
     * @return $this
     */
    public function orWhere(\WDFQVendorFree\Doctrine\Common\Collections\Expr\Expression $expression)
    {
        if ($this->expression === null) {
            return $this->where($expression);
        }
        $this->expression = new \WDFQVendorFree\Doctrine\Common\Collections\Expr\CompositeExpression(\WDFQVendorFree\Doctrine\Common\Collections\Expr\CompositeExpression::TYPE_OR, [$this->expression, $expression]);
        return $this;
    }
    /**
     * Gets the expression attached to this Criteria.
     *
     * @return Expression|null
     */
    public function getWhereExpression()
    {
        return $this->expression;
    }
    /**
     * Gets the current orderings of this Criteria.
     *
     * @return string[]
     */
    public function getOrderings()
    {
        return $this->orderings;
    }
    /**
     * Sets the ordering of the result of this Criteria.
     *
     * Keys are field and values are the order, being either ASC or DESC.
     *
     * @see Criteria::ASC
     * @see Criteria::DESC
     *
     * @param string[] $orderings
     *
     * @return $this
     */
    public function orderBy(array $orderings)
    {
        $this->orderings = \array_map(static function (string $ordering) : string {
            return \strtoupper($ordering) === \WDFQVendorFree\Doctrine\Common\Collections\Criteria::ASC ? \WDFQVendorFree\Doctrine\Common\Collections\Criteria::ASC : \WDFQVendorFree\Doctrine\Common\Collections\Criteria::DESC;
        }, $orderings);
        return $this;
    }
    /**
     * Gets the current first result option of this Criteria.
     *
     * @return int|null
     */
    public function getFirstResult()
    {
        return $this->firstResult;
    }
    /**
     * Set the number of first result that this Criteria should return.
     *
     * @param int|null $firstResult The value to set.
     *
     * @return $this
     */
    public function setFirstResult($firstResult)
    {
        if ($firstResult === null) {
            \WDFQVendorFree\Doctrine\Deprecations\Deprecation::triggerIfCalledFromOutside('doctrine/collections', 'https://github.com/doctrine/collections/pull/311', 'Passing null to %s() is deprecated, pass 0 instead.', __METHOD__);
        }
        $this->firstResult = $firstResult;
        return $this;
    }
    /**
     * Gets maxResults.
     *
     * @return int|null
     */
    public function getMaxResults()
    {
        return $this->maxResults;
    }
    /**
     * Sets maxResults.
     *
     * @param int|null $maxResults The value to set.
     *
     * @return $this
     */
    public function setMaxResults($maxResults)
    {
        $this->maxResults = $maxResults;
        return $this;
    }
}