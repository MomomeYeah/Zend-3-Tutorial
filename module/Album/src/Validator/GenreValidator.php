<?php

namespace Album\Validator;

use Zend\Validator\InArray;

class GenreValidator extends InArray
{
    protected $messageTemplates = [
        self::NOT_IN_ARRAY => "'%value%' is not a valid genre",
    ];
}
