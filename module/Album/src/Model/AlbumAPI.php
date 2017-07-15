<?php

namespace Album\Model;

class AlbumAPI
{
    private $albumTable;

    public function __construct(AlbumTable $albumTable)
    {
        $this->albumTable = $albumTable;
    }

    public function list_all()
    {
        $albums = $this->albumTable->fetchAll();
        $ret = [];
        foreach($albums as $album)
        {
            $ret[$album->id] = $album->getArrayCopy();
        }
        return $ret;
    }

    public function view($id)
    {
        $album = $this->albumTable->getAlbum($id);
        return $album->getArrayCopy();
    }

    public function edit($id, $data)
    {
        $album = new Album($data);
        $album->id = $id;
        $this->albumTable->saveAlbum($album);
        return $this->view($id);
    }

    public function add($data)
    {
        $album = new Album($data);
        $id = $this->albumTable->saveAlbum($album);
        return $this->view($id);
    }

    public function delete($id)
    {
        $this->albumTable->deleteAlbum($id);
        return null;
    }
}
