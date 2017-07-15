<?php

namespace Album\Controller;

use Album\Model\GenreAPI;
use API\Controller\APIController;

class GenreAPIController extends APIController
{
    public function __construct(GenreAPI $api)
    {
        parent::__construct();
        $this->api = $api;
    }
}
