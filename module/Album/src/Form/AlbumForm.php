<?php

namespace Album\Form;

use Zend\Form\Form;

class AlbumForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('album');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);

        $this->add([
            'name' => 'title',
            'type' => 'text',
            'options' => [
                'label' => 'Title',
                'label_attributes' => [
                    'class' => 'control-label',
                ],
            ],
            'attributes' => [
                'class' => "form-control",
                'placeholder' => 'Album Title',
            ]
        ]);

        $this->add([
            'name' => 'artist',
            'type' => 'text',
            'options' => [
                'label' => 'Artist',
                'label_attributes' => [
                    'class' => 'control-label',
                ],
            ],
            'attributes' => [
                'class' => "form-control",
                'placeholder' => 'Artist Name',
            ]
        ]);

        $this->add([
            'name' => 'genre',
            'type' => 'select',
            'options' => [
                'label' => 'Genre',
                'label_attributes' => [
                    'class' => 'control-label',
                ],
                'empty_option' => 'Please select a genre',
                'value_options' => [
                    'funk' => 'Funk',
                    'hiphop' => 'Hip-Hop',
                    'rock' => 'Rock',
                ],
            ],
            'attributes' => [
                'class' => "form-control",
            ]
        ]);

        $this->add([
            'name' => 'record_label',
            'type' => 'Album\Form\RecordLabelSelect',
            'options' => [
                'label' => 'Record Label',
                'label_attributes' => [
                    'class' => 'control-label',
                ],
                'empty_option' => 'Please select a record label',
            ],
            'attributes' => [
                'class' => "form-control",
            ]
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
