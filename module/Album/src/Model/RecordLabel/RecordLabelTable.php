<?php

namespace Album\Model\RecordLabel;

use RuntimeException;
use Application\Model\ApplicationTable;
use Zend\ServiceManager\ServiceManager;

class RecordLabelTable extends ApplicationTable
{
    public function __construct(ServiceManager $serviceManager)
    {
        parent::__construct($serviceManager, RecordLabel::class, "record_label");
    }

    public function fetchAll()
    {
        return $this->tableGateway->select();
    }

    public function fetchAllAsArray()
    {
        $labels = $this->fetchAll();
        $ret = [];
        foreach($labels as $label)
        {
            $ret[$label->id] = $label->name;
        }
        return $ret;
    }

    public function getRecordLabel($id)
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

    public function saveRecordLabel(RecordLabel $record_label)
    {
        $data = $record_label->getArrayCopy();

        $id = (int) $record_label->id;

        if ($id === 0) {
            $this->tableGateway->insert($data);
            return $this->tableGateway->
                getAdapter()->
                getDriver()->
                getLastGeneratedValue('record_label_id_seq');
        }

        if (! $this->getRecordLabel($id)) {
            throw new RuntimeException(sprintf(
                'Cannot update record label with identifier %d; does not exist',
                $id
            ));
        }

        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deleteRecordLabel($id)
    {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}
