<?php

namespace API;

use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'api' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/api/json/album[/]',
                    'defaults' => [
                        'controller' => \Album\Controller\AlbumAPIController::class,
                        'action'     => 'endpoint',
                    ],
                ],
            ],
        ],
    ],
];
