<?php

namespace Juanbenitez\SupabaseApi\Conditions;

class Like extends ConditionBase
{
    public const LIKE = 'like';

    private function __construct(
        string $column,
        $value
    ) {
        $value = '*'.$value.'*';

        $this->build($column, $value, self::LIKE);
    }

    public static function make(string $column, $value): static
    {
        return new static($column, $value);
    }
}
