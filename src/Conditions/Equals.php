<?php

namespace Juanbenitez\SupabaseApi\Conditions;

class Equals extends ConditionBase
{
    public const EQUALS = 'eq';

    private function __construct(
        string $column,
        $value
    ) {
        $this->build($column, strval($value), self::EQUALS);
    }

    public static function make(string $column, $value): static
    {
        return new static($column, $value);
    }
}
