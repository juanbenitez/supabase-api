<?php

namespace Juanbenitez\SupabaseApi\Conditions\Contracts;

interface Condition
{
    public function toQueryString();

    public function toArray();

    public function toNamedArray();
}
