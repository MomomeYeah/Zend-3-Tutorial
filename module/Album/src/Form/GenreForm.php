<?php

namespace Album\Form;

use Laminas\Form\Form;

class GenreForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('genre');

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
                'label' => 'Genre',
                'label_attributes' => [
                    'class' => 'control-label',
                ],
            ],
            'attributes' => [
                'class' => "form-control",
                'placeholder' => 'Genre',
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
