<?php

namespace Album;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\Controller\LazyControllerAbstractFactory;

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
                Form\AlbumForm::class => function($container, $name, $options) {
                    $genreTable = $container->get(Model\GenreTable::class);
                    $recordLabelTable = $container->get(Model\RecordLabelTable::class);
                    return new Form\AlbumForm($name, $options, $genreTable, $recordLabelTable);
                },
                Model\AlbumAPI::class => function($container) {
                    $table = $container->get(Model\AlbumTable::class);
                    return new Model\AlbumAPI($table);
                },
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
                Model\GenreAPI::class => function($container) {
                    $table = $container->get(Model\GenreTable::class);
                    return new Model\GenreAPI($table);
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
                Model\RecordLabelAPI::class => function($container) {
                    $table = $container->get(Model\RecordLabelTable::class);
                    return new Model\RecordLabelAPI($table);
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
                Controller\AlbumAPIController::class => LazyControllerAbstractFactory::class,
                Controller\AlbumController::class => LazyControllerAbstractFactory::class,
                Controller\AlbumRESTController::class => function($container) {
                    return new Controller\AlbumRESTController(
                        $container->get(Model\AlbumAPI::class)
                    );
                },
                Controller\GenreAPIController::class => LazyControllerAbstractFactory::class,
                Controller\GenreController::class => LazyControllerAbstractFactory::class,
                Controller\GenreRESTController::class => function($container) {
                    return new Controller\GenreRESTController(
                        $container->get(Model\GenreAPI::class)
                    );
                },
                Controller\RecordLabelAPIController::class => LazyControllerAbstractFactory::class,
                Controller\RecordLabelController::class => LazyControllerAbstractFactory::class,
                Controller\RecordLabelRESTController::class => function($container) {
                    return new Controller\RecordLabelRESTController(
                        $container->get(Model\RecordLabelAPI::class)
                    );
                },
            ],
        ];
    }
}
