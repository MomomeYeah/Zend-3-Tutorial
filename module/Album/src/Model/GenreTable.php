<?php

namespace Album\Model;

use RuntimeException;
use Application\Model\ApplicationTable;
use Zend\ServiceManager\ServiceManager;

class GenreTable extends ApplicationTable
{
    public function __construct(ServiceManager $serviceManager)
    {
        parent::__construct($serviceManager, "genre");
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function fetchAllAsArray()
    {
        $genres = $this->fetchAll();
        $ret = [];
        foreach($genres as $genre)
        {
            $ret[$genre->id] = $genre->name;
        }
        return $ret;
    }

    public function getGenre($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }

        return $row;
    }

    public function saveGenre(Genre $genre)
    {
        $data = $genre->getArrayCopy();

        $id = (int) $genre->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return $this->tableGateway->
                getAdapter()->
                getDriver()->
                getLastGeneratedValue('genre_id_seq');
        }

        if (! $this->getGenre($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update genre with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteGenre($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}
