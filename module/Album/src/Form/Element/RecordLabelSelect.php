<?php

namespace Album\Form\Element;

use Application\Form\Element\ApplicationSelect;
use Album\Validator\RecordLabelValidator;

class RecordLabelSelect extends ApplicationSelect {
    protected function getValidatorType()
    {
        return RecordLabelValidator::class;
    }
}
