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
            $ret[$album->id] = [
                "artist"    => $album->artist,
                "title"     => $album->title,
            ];
        }
        return $ret;
    }
}
