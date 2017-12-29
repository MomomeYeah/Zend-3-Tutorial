<?php

namespace Album\Form;

use Zend\Form\Form;

class RecordLabelForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('record-label');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);

        $this->add([
            'name' => 'csrf',
            'type' => 'csrf',
        ]);

        $this->add([
            'name' => 'name',
            'type' => 'text',
            'options' => [
                'label' => 'Record Label',
                'label_attributes' => [
                    'class' => 'control-label',
                ],
            ],
            'attributes' => [
                'class' => "form-control",
                'placeholder' => 'Record Label',
            ],
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'id'    => 'submitbutton',
                'value' => 'Go',
                'class' => 'btn btn-primary'
            ],
        ]);
    }
}
