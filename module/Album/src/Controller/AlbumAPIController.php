<?php

namespace Album\Controller;

use Album\Model\AlbumAPI;
use API\Controller\APIController;

class AlbumAPIController extends APIController
{
    public function __construct(AlbumAPI $api)
    {
        parent::__construct();
        $this->api = $api;
    }
}
