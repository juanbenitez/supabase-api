<?php
namespace Juanbenitez\SupabaseApi\Request;

use Exception;
use Juanbenitez\SupabaseApi\Trait\CanLimit;
use Juanbenitez\SupabaseApi\Trait\CanOrder;
use Juanbenitez\SupabaseApi\Trait\CanFilter;
use Juanbenitez\SupabaseApi\Request\SupabaseRequest;
use Juanbenitez\SupabaseApi\Connector\SupabaseConnector;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;

class ReadRowsRequest extends SupabaseRequest
{
    use CanFilter;
    use CanOrder;
    use CanLimit;
    
    protected ?string $connector = SupabaseConnector::class;

    protected ?string $method = Saloon::GET;

    public function __construct(){
        $this->selectAll();
    }

    public function selectAll(): static
    {
        $this->addQuery('select', '*');
        return $this;
    }

    public function select(array $fields = []): static
    {
        if(empty($fields))
            $this->selectAll();
        else
            $this->addQuery('select', implode(',', $fields));

        return $this;
    }
}
