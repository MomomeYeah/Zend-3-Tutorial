<?php

namespace Album\Model;

class GenreAPI
{
    private $albumTable;

    public function __construct(GenreTable $genreTable)
    {
        $this->genreTable = $genreTable;
    }

    public function list_all()
    {
        $genres = $this->genreTable->fetchAll();
        $ret = [];
        foreach($genres as $genre)
        {
            $ret[$genre->id] = [
                "name"  => $genre->name,
            ];
        }
        return $ret;
    }
}
