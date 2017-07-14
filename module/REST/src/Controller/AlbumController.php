<?php

namespace REST\Controller;

use Album\Model\AlbumAPI;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class AlbumController extends AbstractRestfulController
{
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
