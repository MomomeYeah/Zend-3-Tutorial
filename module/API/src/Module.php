<?php

namespace API;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\Controller\LazyControllerAbstractFactory;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\APIController::class => LazyControllerAbstractFactory::class,
            ],
        ];
    }
}
