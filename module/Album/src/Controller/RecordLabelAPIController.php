<?php

namespace Album\Controller;

use Album\Model\RecordLabelAPI;
use API\Controller\APIController;

class RecordLabelAPIController extends APIController
{
    public function __construct(RecordLabelAPI $api)
    {
        parent::__construct();
        $this->api = $api;
    }
}
