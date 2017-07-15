<?php

namespace Album\Controller;

use Album\Model\RecordLabelAPI;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class RecordLabelRESTController extends AbstractRestfulController
{
    private $api;

    public function __construct(RecordLabelAPI $api)
    {
        $this->api = $api;
    }

    public function getList()
    {
        return new JsonModel([
            'status' => 'SUCCESS',
            'message'=>'Here is your data',
            'data' => [
                'full_name' => 'John Doe',
                'address' => '51 Middle st.'
            ]
        ]);
    }

    public function get($id)
    {
        return new JsonModel([
            'status' => 'SUCCESS',
            'message'=>'Here is your data 2',
            'data' => [
                'full_name' => 'John Doe 2',
                'address' => '51 Middle st. 2'
            ]
        ]);
    }

    public function update($id, $data)
    {
        return new JsonModel([
            'status' => 'SUCCESS',
            'message'=>'Here is your data 3',
            'data' => [
                'full_name' => 'John Doe 3',
                'address' => '51 Middle st. 3'
            ]
        ]);
    }

    public function create($data)
    {
        return new JsonModel([
            'status' => 'SUCCESS',
            'message'=>'Here is your data 4',
            'data' => [
                'full_name' => 'John Doe 4',
                'address' => '51 Middle st. 4'
            ]
        ]);
    }

    public function delete($id)
    {
        return new JsonModel([
            'status' => 'SUCCESS',
            'message'=>'Here is your data 5',
            'data' => [
                'full_name' => 'John Doe 5',
                'address' => '51 Middle st. 5'
            ]
        ]);
    }
}
