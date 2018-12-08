<?php

namespace Album\Controller;

use Album\Form\AlbumForm;
use Album\Model\Album\Album;
use Album\Model\Album\AlbumTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\ServiceManager\ServiceManager;
use Zend\View\Model\ViewModel;

class AlbumController extends AbstractActionController
{
    private $albumTable;
    private $albumForm;

    public function __construct(ServiceManager $serviceManager)
    {
        $this->albumTable = $serviceManager->get(AlbumTable::class);
        $this->albumForm = $serviceManager->get(AlbumForm::class);
    }

    public function indexAction()
    {
        return new ViewModel([
            'albums' => $this->albumTable->fetchAll(),
        ]);
    }

    public function addAction()
    {
        $form = $this->albumForm;
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if ( ! $request->isPost() )
        {
            return ['form' => $form];
        }

        $album = new Album();
        $form->setInputFilter($album->getInputFilter());
        $form->setData($request->getPost());

        if ( ! $form->isValid() )
        {
            return ['form' => $form];
        }

        $album->exchangeArray($form->getData());
        $this->albumTable->saveAlbum($album);
        return $this->redirect()->toRoute('album');
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if ( 0 === $id )
        {
            return $this->redirect()->toRoute('album', ['action' => 'add']);
        }

        // Retrieve the album with the specified id. Doing so raises
        // an exception if the album is not found, which should result
        // in redirecting to the landing page.
        try
        {
            $album = $this->albumTable->getAlbum($id);
        }
        catch (\Exception $e)
        {
            return $this->redirect()->toRoute('album', ['action' => 'index']);
        }

        $form = $this->albumForm;
        $form->bind($album);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if ( ! $request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($album->getInputFilter());
        $form->setData($request->getPost());

        if ( ! $form->isValid()) {
            return $viewData;
        }

        $this->albumTable->saveAlbum($album);

        // Redirect to album list
        return $this->redirect()->toRoute('album', ['action' => 'index']);
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id)
        {
            return $this->redirect()->toRoute('album');
        }

        $request = $this->getRequest();
        if ($request->isPost())
        {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes')
            {
                $id = (int) $request->getPost('id');
                $this->albumTable->deleteAlbum($id);
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('album');
        }

        return [
            'id'    => $id,
            'album' => $this->albumTable->getAlbum($id),
        ];
    }
}
