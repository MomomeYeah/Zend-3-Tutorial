<?php

namespace Album\Model\Genre;

class GenreAPI
{
    private $genreTable;

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
            $ret[$genre->id] = $genre->getArrayCopy();
        }
        return $ret;
    }

    public function view($id)
    {
        $genre = $this->genreTable->getGenre($id);
        return $genre->getArrayCopy();
    }

    public function edit($id, $data)
    {
        $genre = new Genre($data);
        $genre->id = $id;
        $this->genreTable->saveGenre($genre);
        return $this->view($id);
    }

    public function add($data)
    {
        $genre = new Genre($data);
        $id = $this->genreTable->saveGenre($genre);
        return $this->view($id);
    }

    public function delete($id)
    {
        $this->genreTable->deleteGenre($id);
        return null;
    }
}
