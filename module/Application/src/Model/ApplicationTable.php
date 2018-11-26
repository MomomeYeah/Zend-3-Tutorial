<?php

namespace Application\Model;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\ServiceManager;

class ApplicationTable
{
    protected $tableGateway;

    public function __construct(ServiceManager $serviceManager, $table)
    {
        $dbAdapter = $serviceManager->get(AdapterInterface::class);
        $resultSetPrototype = new ResultSet();
        $this->tableGateway = new TableGateway($table, $dbAdapter, null, $resultSetPrototype);
    }
}
