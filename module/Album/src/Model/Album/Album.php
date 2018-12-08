<?php

namespace Album\Model\Album;

use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\Validator\StringLength;

use Application\Model\Entity;

class Album extends Entity
{
    public $id;
    public $artist;
    public $title;
    public $genre;
    public $record_label;
    public $pre_release;

    public function getInputFilter()
    {
        if ($this->inputFilter) {
            return $this->inputFilter;
        }

        $inputFilter = new InputFilter();

        $inputFilter->add([
            'name' => 'id',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ]);

        $inputFilter->add([
            'name' => 'artist',
            'required' => true,
            'filters' => [
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'title',
            'required' => true,
            'filters' => [
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'genre',
            'required' => true,
            'filters' => [],
            'validators' => [],
        ]);

        $inputFilter->add([
            'name' => 'record_label',
            'required' => true,
            'filters' => [],
            'validators' => [],
        ]);

        $inputFilter->add([
            'name' => 'pre_release',
            'required' => true,
            'filters' => [],
            'validators' => [],
        ]);

        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }
}
