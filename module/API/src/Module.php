<?php

namespace API;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\Mvc\Controller\LazyControllerAbstractFactory;

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
