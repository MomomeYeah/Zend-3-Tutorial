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
            $ret[$recordLabel->id] = [
                "name"  => $recordLabel->name,
            ];
        }
        return $ret;
    }
}
