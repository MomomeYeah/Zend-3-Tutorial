<?php

namespace Album\Form\Element;

use Application\Form\Element\ApplicationSelect;
use Album\Validator\GenreValidator;

class GenreSelect extends ApplicationSelect {
    protected function getValidatorType()
    {
        return GenreValidator::class;
    }
}
