<?php

namespace Juanbenitez\SupabaseApi\Conditions;

class NotEqual extends ConditionBase
{
    public const NOT = 'not';

    private function __construct(
        string $column,
        $value
    ) {
        if (is_null($value)) {
            $value = 'null';
        }

        $this->build($column, Equals::make($column, $value)->value, self::NOT);
    }

    public static function make(string $column, $value): static
    {
        return new static($column, $value);
    }
}
