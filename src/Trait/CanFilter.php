<?php

namespace Juanbenitez\SupabaseApi\Trait;

use Juanbenitez\SupabaseApi\Conditions\ConditionBase;
use Juanbenitez\SupabaseApi\Conditions\Equals;
use Juanbenitez\SupabaseApi\Conditions\Ilike;
use Juanbenitez\SupabaseApi\Conditions\Like;
use Juanbenitez\SupabaseApi\Conditions\NotEqual;
use Juanbenitez\SupabaseApi\Conditions\OrWhere;

trait CanFilter
{
    public function where(
        string $column,
        $value,
        string $operator = Equals::EQUALS
    ): static {
        $this->addQuery($column, (new ConditionBase())->build($column, $value, $operator)->value);

        return $this;
    }

    public function equals(
        string $column,
        $value
    ): static {
        $this->addQuery($column, Equals::make($column, $value)->value);

        return $this;
    }

    public function ilike(string $column, $value)
    {
        return $this->like($column, $value, caseInsensitive: true);
    }

    public function like(string $column, $value, $caseInsensitive = false)
    {
        if ($caseInsensitive) {
            return $this->addQuery($column, Ilike::make($column, $value, Ilike::ILIKE)->value);
        }

        return $this->addQuery($column, Like::make($column, $value, Like::LIKE)->value);
    }

    public function neq(string $column, $value)
    {
        $this->addQuery($column, NotEqual::make($column, $value)->value);

        return $this;
    }

    public function orWhere(array $conditions)
    {
        foreach ($conditions as $condition) {
            $column = $condition[0];
            $value = $condition[1];
            $operator = $condition[2];
            $newConditions[] = (new ConditionBase())->build($column, $value, $operator);
        }

        $orCondition = OrWhere::make($newConditions);
        $this->addQuery($orCondition->field, $orCondition->value);

        return $this;
    }
}
