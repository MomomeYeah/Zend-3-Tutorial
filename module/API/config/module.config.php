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
                        'action'        => 'endpoint',
                        'controller'    => Controller\APIController::class,
                    ],
                ],
                'child_routes' => [
                    'album' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route' => '/album',
                            'defaults' => [
                                'api_class' => \Album\Model\AlbumAPI::class,
                            ],
                        ],
                    ],
                    'genre' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route' => '/genre',
                            'defaults' => [
                                'api_class' => \Album\Model\GenreAPI::class,
                            ],
                        ],
                    ],
                    'record_label' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route' => '/record-label',
                            'defaults' => [
                                'api_class' => \Album\Model\RecordLabelAPI::class,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
