<?php

namespace Juanbenitez\SupabaseApi\Conditions;

class Ilike extends ConditionBase
{
    public const ILIKE = 'ilike';

    private function __construct(
        string $column,
        $value
    ) {
        $value = '*'.$value.'*';

        $this->build($column, $value, self::ILIKE);
    }

    public static function make(string $column, $value): static
    {
        return new static($column, $value);
    }
}
