<?php

namespace Album\Controller;

use Album\Model\Album\AlbumAPI;
use REST\Controller\RESTController;

class AlbumRESTController extends RESTController
{
    public function __construct(AlbumAPI $api)
    {
        parent::__construct();
        $this->api = $api;
    }
}
