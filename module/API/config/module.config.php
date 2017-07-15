<?php

namespace API;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'api_json' => [
                'type'    => Literal::class,
                'options' => [
                    'route' => '/api/json',
                    'defaults' => [
                        'action'    => 'endpoint',
                    ],
                ],
                'child_routes' => [
                    'album' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route' => '/album',
                            'defaults' => [
                                'controller' => \Album\Controller\AlbumAPIController::class
                            ],
                        ],
                    ],
                    'genre' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route' => '/genre',
                            'defaults' => [
                                'controller' => \Album\Controller\GenreAPIController::class
                            ],
                        ],
                    ],
                    'record_label' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route' => '/record-label',
                            'defaults' => [
                                'controller' => \Album\Controller\RecordLabelAPIController::class
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
