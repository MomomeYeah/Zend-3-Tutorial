<?php

namespace Album\Controller;

use Album\Form\RecordLabelForm;
use Album\Model\RecordLabel;
use Album\Model\RecordLabelTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class RecordLabelController extends AbstractActionController
{
    private $recordLabelTable;

    public function __construct(RecordLabelTable $recordLabelTable)
    {
        $this->recordLabelTable = $recordLabelTable;
    }

    public function indexAction()
    {
        return new ViewModel([
            'record_labels' => $this->recordLabelTable->fetchAll(),
        ]);
    }

    public function addAction()
    {

        $form = new RecordLabelForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if ( ! $request->isPost() )
        {
            return ['form' => $form];
        }

        $record_label = new RecordLabel();
        $form->setInputFilter($record_label->getInputFilter());
        $form->setData($request->getPost());

        if ( ! $form->isValid() )
        {
            return ['form' => $form];
        }

        $record_label->exchangeArray($form->getData());
        $this->recordLabelTable->saveRecordLabel($record_label);
        return $this->redirect()->toRoute('record_label');
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if ( 0 === $id )
        {
            return $this->redirect()->toRoute('record_label', ['action' => 'add']);
        }

        // Retrieve the record_label with the specified id. Doing so raises
        // an exception if the record_label is not found, which should result
        // in redirecting to the landing page.
        try
        {
            $record_label = $this->recordLabelTable->getRecordLabel($id);
        }
        catch (\Exception $e)
        {
            return $this->redirect()->toRoute('record_label', ['action' => 'index']);
        }

        $form = new RecordLabelForm();
        $form->bind($record_label);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if ( ! $request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($record_label->getInputFilter());
        $form->setData($request->getPost());

        if ( ! $form->isValid()) {
            return $viewData;
        }

        $this->recordLabelTable->saveRecordLabel($record_label);

        // Redirect to record_label list
        return $this->redirect()->toRoute('record_label', ['action' => 'index']);
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id)
        {
            return $this->redirect()->toRoute('record_label');
        }

        $request = $this->getRequest();
        if ($request->isPost())
        {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes')
            {
                $id = (int) $request->getPost('id');
                $this->recordLabelTable->deleteRecordLabel($id);
            }

            // Redirect to list of record_labels
            return $this->redirect()->toRoute('record_label');
        }

        return [
            'id'    => $id,
            'record_label' => $this->recordLabelTable->getRecordLabel($id),
        ];
    }
}
