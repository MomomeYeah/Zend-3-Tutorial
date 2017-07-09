<?php

namespace Album\Form;

use Zend\Form\Element\Select;
use Zend\Validator\Explode as ExplodeValidator;
use Album\Validator\GenreValidator;

class GenreSelect extends Select {

    /**
     * Get validator
     *
     * @return \Zend\Validator\ValidatorInterface
     */
    protected function getValidator()
    {
        if (null === $this->validator && ! $this->disableInArrayValidator()) {
            $validator = new GenreValidator([
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