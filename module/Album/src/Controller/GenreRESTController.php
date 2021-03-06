<?php

namespace Album\Controller;

use Album\Model\Genre\GenreAPI;
use REST\Controller\RESTController;

class GenreRESTController extends RESTController
{
    public function __construct(GenreAPI $api)
    {
        parent::__construct();
        $this->api = $api;
    }
}
