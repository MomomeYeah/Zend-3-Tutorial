<?php

namespace Album\Validator;

use Laminas\Validator\InArray;

class GenreValidator extends InArray
{
    protected $messageTemplates = [
        self::NOT_IN_ARRAY => "'%value%' is not a valid genre",
    ];
}
