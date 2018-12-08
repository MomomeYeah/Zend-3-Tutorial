<?php

namespace Album\Model\Album;

use RuntimeException;
use Application\Model\ApplicationTable;
use Zend\ServiceManager\ServiceManager;

class AlbumTable extends ApplicationTable
{
    public function __construct(ServiceManager $serviceManager)
    {
        parent::__construct($serviceManager, Album::class, "album");
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function getAlbum($id)
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

    public function saveAlbum(Album $album)
    {
        $data = $album->getArrayCopy();

        $id = (int) $album->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return $this->tableGateway->
                getAdapter()->
                getDriver()->
                getLastGeneratedValue('album_id_seq');
        }

        if (! $this->getAlbum($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update album with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteAlbum($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}
