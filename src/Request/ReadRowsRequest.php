<?php

namespace Juanbenitez\SupabaseApi\Request;

use Juanbenitez\SupabaseApi\Connector\SupabaseConnector;
use Juanbenitez\SupabaseApi\Trait\CanFilter;
use Juanbenitez\SupabaseApi\Trait\CanLimit;
use Juanbenitez\SupabaseApi\Trait\CanOrder;
use Sammyjo20\Saloon\Constants\Saloon;

class ReadRowsRequest extends SupabaseRequest
{
    use CanFilter;
    use CanOrder;
    use CanLimit;

    protected ?string $connector = SupabaseConnector::class;

    protected ?string $method = Saloon::GET;

    public function __construct()
    {
        $this->selectAll();
    }

    public function selectAll(): static
    {
        $this->addQuery('select', '*');

        return $this;
    }

    public function select(array $fields = []): static
    {
        if (empty($fields)) {
            $this->selectAll();
        } else {
            $this->addQuery('select', implode(',', $fields));
        }

        return $this;
    }

    public function toArray()
    {
        return $this->getQuery();
    }
}
