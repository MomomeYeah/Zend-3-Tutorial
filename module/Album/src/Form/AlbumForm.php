<?php

namespace Album\Form;

use Laminas\Form\Form;
use Album\Form\Element\GenreSelect;
use Album\Form\Element\RecordLabelSelect;
use Album\Model\Genre\GenreTable;
use Album\Model\RecordLabel\RecordLabelTable;

class AlbumForm extends Form
{
    public function __construct($name = null, $options = [],
        GenreTable $genreTable, RecordLabelTable $recordLabelTable)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('album');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);

        $this->add([
            'name' => 'csrf',
            'type' => 'csrf',
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
                'field-required' => 'true',
                'help-text' => 'The title of the album',
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
                'field-optional' => 'true',
            ]
        ]);

        $this->add([
            'name' => 'genre',
            'type' => GenreSelect::class,
            'options' => [
                'label' => 'Genre',
                'label_attributes' => [
                    'class' => 'control-label',
                ],
                'empty_option' => 'Please select a genre',
                'value_options' => $genreTable->fetchAllAsArray(),
            ],
            'attributes' => [
                'class' => "form-control",
            ]
        ]);

        $this->add([
            'name' => 'record_label',
            'type' => RecordLabelSelect::class,
            'options' => [
                'label' => 'Record Label',
                'label_attributes' => [
                    'class' => 'control-label',
                ],
                'empty_option' => 'Please select a record label',
                'value_options' => $recordLabelTable->fetchAllAsArray(),
            ],
            'attributes' => [
                'class' => "form-control",
            ]
        ]);

        $this->add([
            'name' => 'pre_release',
            'type' => 'select',
            'options' => [
                'label' => 'Pre-Release',
                'label_attributes' => [
                    'class' => 'control-label',
                ],
                'empty_option' => 'Is this album currently pre-release?',
                'value_options' => [
                    'yes' => 'Yes',
                    'no' => 'No',
                ],
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
