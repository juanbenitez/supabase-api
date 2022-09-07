<?php

namespace Juanbenitez\SupabaseApi\Conditions;

use Juanbenitez\SupabaseApi\Conditions\Contracts\Condition;

class ConditionBase implements Condition
{
    protected $filtersAllowed = [
        'eq', 'neq', 'like', 'ilike', 'not',
        'gt', 'gte', 'lt', 'lte', 'is', 'in',
    ];

    protected array $data = [
        'field' => null,
        'value' => null,
    ];
    protected string $param_field;
    protected string $param_value;

    public function build(string $column, $value, $operator)
    {
        if (! in_array($operator, $this->filtersAllowed)) {
            throw new \Exception('Invalid operator in where clause.');
        }
        if (is_null($value)) {
            $value = 'null';
        }

        $this->data['field'] = $column;
        $this->data['value'] = implode('.', [$operator, $value]);

        return $this;
    }

    public function toQueryString(): string
    {
        return http_build_query($this->data);
    }

    public function toArray(): array
    {
        return [
            $this->data['field'] => $this->data['value'],
        ];
    }

    public function toNamedArray(): array
    {
        return $this->data;
    }

    public function __get($name)
    {
        if (! array_key_exists($name, $this->data)) {
            return null;
        }

        return $this->data[$name];
    }

    public function __set($name, $value)
    {
        if (! array_key_exists($name, $this->data)) {
            return null;
        }

        $this->data[$name] = $value;
    }
}
