<?php

namespace Album\Controller;

use Album\Model\RecordLabel\RecordLabelAPI;
use REST\Controller\RESTController;

class RecordLabelRESTController extends RESTController
{
    public function __construct(RecordLabelAPI $api)
    {
        parent::__construct();
        $this->api = $api;
    }
}
