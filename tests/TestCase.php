<?php

namespace Juanbenitez\SupabaseApi\Tests;

use Juanbenitez\SupabaseApi\Connector\SupabaseConnector;
use Juanbenitez\SupabaseApi\Request\ReadRowsRequest;

class TestCase extends \PHPUnit\Framework\TestCase
{
    protected $connector;
    protected $readRows;

    protected function setUp(): void
    {
        $this->connector = new SupabaseConnector('https://testbaseurl.supabase.co/rest/v1/', 'TEST_SUPABASE_SERVICE_KEY');
        $this->readRows = $this->connector->request(new ReadRowsRequest());
        $this->readRows->setTable('test_table');
    }
}
