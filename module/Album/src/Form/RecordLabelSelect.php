<?php

namespace Album\Form;

use Zend\Form\Element\Select;
use Zend\Validator\Explode as ExplodeValidator;
use Album\Model\DataTable;
use Album\Validator\RecordLabelValidator;

class RecordLabelSelect extends Select {

    // TODO: if data function call fails, this will throw an exception
    // TODO: catch this in the controller and redirect?
    public function init() {
        $dataTable = new DataTable();
        $this->setValueOptions($dataTable->get_record_labels());
    }

    /**
     * Get validator
     *
     * @return \Zend\Validator\ValidatorInterface
     */
    protected function getValidator()
    {
        if (null === $this->validator && ! $this->disableInArrayValidator()) {
            $validator = new RecordLabelValidator([
                'haystack' => $this->getValueOptionsValues(),
                'strict'   => false
            ]);

            if ($this->isMultiple()) {
                $validator = new ExplodeValidator([
                    'validator'      => $validator,
                    'valueDelimiter' => null, // skip explode if only one value
                ]);
            }

            $this->validator = $validator;
        }
        return $this->validator;
    }

}
