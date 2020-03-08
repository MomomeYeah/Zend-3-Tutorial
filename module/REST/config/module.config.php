<?php

namespace REST;

use Laminas\Router\Http\Segment;

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
        'aliases' => [
            'album'         => \Album\Controller\AlbumRESTController::class,
            'genre'         => \Album\Controller\GenreRESTController::class,
            'record-label'  => \Album\Controller\RecordLabelRESTController::class,
        ]
    ],

    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
];
