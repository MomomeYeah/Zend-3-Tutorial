<?php

namespace Application\Form\Element;

use Laminas\Form\Element\Select;

abstract class ApplicationSelect extends Select {

    abstract protected function getValidatorType();

    /**
     * Get validator
     *
     * @return \Laminas\Validator\ValidatorInterface
     */
    protected function getValidator()
    {
        $validatorType = $this->getValidatorType();
        if (null === $this->validator && ! $this->disableInArrayValidator()) {
            $validator = new $validatorType([
                'haystack' => $this->getValueOptionsValues(),
                'strict'   => false
            ]);

            if ($this->isMultiple()) {
                $validator = new Explode([
                    'validator'      => $validator,
                    'valueDelimiter' => null, // skip explode if only one value
                ]);
            }

            $this->validator = $validator;
        }
        return $this->validator;
    }
}
