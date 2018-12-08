<?php

namespace Album;

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
                    $genreTable = $container->get(Model\Genre\GenreTable::class);
                    $recordLabelTable = $container->get(Model\RecordLabel\RecordLabelTable::class);
                    return new Form\AlbumForm($name, $options, $genreTable, $recordLabelTable);
                },
                Model\Album\AlbumAPI::class => LazyControllerAbstractFactory::class,
                Model\Album\AlbumTable::class => LazyControllerAbstractFactory::class,
                Model\Genre\GenreAPI::class => LazyControllerAbstractFactory::class,
                Model\Genre\GenreTable::class => LazyControllerAbstractFactory::class,
                Model\RecordLabel\RecordLabelAPI::class => LazyControllerAbstractFactory::class,
                Model\RecordLabel\RecordLabelTable::class => LazyControllerAbstractFactory::class,
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
