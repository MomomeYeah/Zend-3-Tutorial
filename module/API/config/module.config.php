<?php

namespace API;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

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
                                'api_class' => \Album\Model\Album\AlbumAPI::class,
                            ],
                        ],
                    ],
                    'genre' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route' => '/genre',
                            'defaults' => [
                                'api_class' => \Album\Model\Genre\GenreAPI::class,
                            ],
                        ],
                    ],
                    'record_label' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route' => '/record-label',
                            'defaults' => [
                                'api_class' => \Album\Model\RecordLabel\RecordLabelAPI::class,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
