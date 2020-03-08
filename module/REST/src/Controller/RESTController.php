<?php

namespace REST\Controller;

use Laminas\Mvc\Controller\AbstractRestfulController;
use Laminas\View\Model\JsonModel;

class RESTController extends AbstractRestfulController
{
    protected $api;

    public function __construct()
    {
        $this->api = NULL;
    }

    public function getList()
    {
        return new JsonModel($this->api->list_all());
    }

    public function get($id)
    {
        return new JsonModel($this->api->view($id));
    }

    public function update($id, $data)
    {
        return new JsonModel($this->api->edit($id, $data));
    }

    public function create($data)
    {
        return new JsonModel($this->api->add($data));
    }

    public function delete($id)
    {
        return new JsonModel($this->api->delete($id));
    }
}
