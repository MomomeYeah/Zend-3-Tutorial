<?php

namespace Application\Model;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\ServiceManager;

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
