<?php

namespace REST;

use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'api_rest' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/api/rest/:controller[/:id]',
                ],
            ],
        ],
    ],

    'controllers' => [
        'factories' => [
            Controller\AlbumController::class => InvokableFactory::class,
        ],
        'aliases' => [
            'album' => Controller\AlbumController::class
        ]
    ],

    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
];
