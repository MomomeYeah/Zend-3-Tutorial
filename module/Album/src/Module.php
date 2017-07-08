<?php

namespace Album;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\AlbumTable::class => function($container) {
                    $tableGateway = $container->get(Model\AlbumTableGateway::class);
                    return new Model\AlbumTable($tableGateway);
                },
                Model\AlbumTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Album());
                    return new TableGateway('album', $dbAdapter, null, $resultSetPrototype);
                },
                Model\GenreTable::class => function($container) {
                    $tableGateway = $container->get(Model\GenreTableGateway::class);
                    return new Model\GenreTable($tableGateway);
                },
                Model\GenreTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Genre());
                    return new TableGateway('genre', $dbAdapter, null, $resultSetPrototype);
                },
                Model\RecordLabelTable::class => function($container) {
                    $tableGateway = $container->get(Model\RecordLabelTableGateway::class);
                    return new Model\RecordLabelTable($tableGateway);
                },
                Model\RecordLabelTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\RecordLabel());
                    return new TableGateway('record_label', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\AlbumController::class => function($container) {
                    return new Controller\AlbumController(
                        $container->get(Model\AlbumTable::class)
                    );
                },
                Controller\GenreController::class => function($container) {
                    return new Controller\GenreController(
                        $container->get(Model\GenreTable::class)
                    );
                },
                Controller\RecordLabelController::class => function($container) {
                    return new Controller\RecordLabelController(
                        $container->get(Model\RecordLabelTable::class)
                    );
                },
            ],
        ];
    }
}
