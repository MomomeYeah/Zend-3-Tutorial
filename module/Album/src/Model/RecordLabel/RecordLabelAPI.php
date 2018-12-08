<?php

namespace Album\Model;

class RecordLabelAPI
{
    private $recordLabelTable;

    public function __construct(RecordLabelTable $recordLabelTable)
    {
        $this->recordLabelTable = $recordLabelTable;
    }

    public function list_all()
    {
        $recordLabels = $this->recordLabelTable->fetchAll();
        $ret = [];
        foreach($recordLabels as $recordLabel)
        {
            $ret[$recordLabel->id] = $recordLabel->getArrayCopy();
        }
        return $ret;
    }

    public function view($id)
    {
        $recordLabel = $this->recordLabelTable->getRecordLabel($id);
        return $recordLabel->getArrayCopy();
    }

    public function edit($id, $data)
    {
        $recordLabel = new RecordLabel($data);
        $recordLabel->id = $id;
        $this->recordLabelTable->saveRecordLabel($recordLabel);
        return $this->view($id);
    }

    public function add($data)
    {
        $recordLabel = new RecordLabel($data);
        $id = $this->recordLabelTable->saveRecordLabel($recordLabel);
        return $this->view($id);
    }

    public function delete($id)
    {
        $this->recordLabelTable->deleteRecordLabel($id);
        return null;
    }
}
