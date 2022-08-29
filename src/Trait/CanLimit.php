<?php

namespace Juanbenitez\SupabaseApi\Trait;

trait CanLimit
{
    public function limit(int $limit, int $offset = null): static
    {
        $this->addQuery('limit', $limit);

        if (! is_null($offset)) {
            $this->addQuery('offset', $offset);
        }

        return $this;
    }
}
