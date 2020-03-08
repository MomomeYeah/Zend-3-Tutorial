<?php

namespace Application\Model;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\ServiceManager\ServiceManager;

class ApplicationTable
{
    protected $tableGateway;

    public function __construct(ServiceManager $serviceManager, $prototype, $table)
    {
        $dbAdapter = $serviceManager->get(AdapterInterface::class);
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new $prototype());
        $this->tableGateway = new TableGateway($table, $dbAdapter, null, $resultSetPrototype);
    }
}
