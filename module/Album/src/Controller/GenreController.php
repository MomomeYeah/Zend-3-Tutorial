<?php

namespace Album\Controller;

use Album\Form\GenreForm;
use Album\Model\Genre\Genre;
use Album\Model\Genre\GenreTable;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\ServiceManager\ServiceManager;
use Laminas\View\Model\ViewModel;

class GenreController extends AbstractActionController
{
    private $genreTable;

    public function __construct(ServiceManager $serviceManager)
    {
        $this->genreTable = $serviceManager->get(GenreTable::class);
    }

    public function indexAction()
    {
        return new ViewModel([
            'genres' => $this->genreTable->fetchAll(),
        ]);
    }

    public function addAction()
    {

        $form = new GenreForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if ( ! $request->isPost() )
        {
            return ['form' => $form];
        }

        $genre = new Genre();
        $form->setInputFilter($genre->getInputFilter());
        $form->setData($request->getPost());

        if ( ! $form->isValid() )
        {
            return ['form' => $form];
        }

        $genre->exchangeArray($form->getData());
        $this->genreTable->saveGenre($genre);
        return $this->redirect()->toRoute('genre');
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if ( 0 === $id )
        {
            return $this->redirect()->toRoute('genre', ['action' => 'add']);
        }

        // Retrieve the genre with the specified id. Doing so raises
        // an exception if the genre is not found, which should result
        // in redirecting to the landing page.
        try
        {
            $genre = $this->genreTable->getGenre($id);
        }
        catch (\Exception $e)
        {
            return $this->redirect()->toRoute('genre', ['action' => 'index']);
        }

        $form = new GenreForm();
        $form->bind($genre);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if ( ! $request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($genre->getInputFilter());
        $form->setData($request->getPost());

        if ( ! $form->isValid()) {
            return $viewData;
        }

        $this->genreTable->saveGenre($genre);

        // Redirect to genre list
        return $this->redirect()->toRoute('genre', ['action' => 'index']);
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id)
        {
            return $this->redirect()->toRoute('genre');
        }

        $request = $this->getRequest();
        if ($request->isPost())
        {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes')
            {
                $id = (int) $request->getPost('id');
                $this->genreTable->deleteGenre($id);
            }

            // Redirect to list of genres
            return $this->redirect()->toRoute('genre');
        }

        return [
            'id'    => $id,
            'genre' => $this->genreTable->getGenre($id),
        ];
    }
}
