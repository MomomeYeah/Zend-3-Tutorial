<?php
namespace Application\Form\View\Helper;

use Zend\Form\View\Helper\FormLabel as OriginalFormLabel;
use Zend\Form\ElementInterface;

/**
 * Add mark (*) for all required elements inside a form.
 */
class Required extends OriginalFormLabel
{
    private function getSpan($text, $class)
    {
        return '<span class="' . $class . '">' . $text . '</span>';
    }

    private function getRequired()
    {
        return $this->getSpan(" *", "required-mark");
    }

    private function getOptional()
    {
        return $this->getSpan(" (optional)", "optional-mark");
    }

     /**
     * Invokable
     *
     * @return str
     */
    public function __invoke(ElementInterface $element = null, $labelContent = null, $position = null)
    {
        $label = $element->getLabel();
        $label_content = NULL;
        // check if element is required
        if ( $element->hasAttribute('field-required') )
        {
            $label_content = $label . $this->getRequired();
        }
        // check if element is optional
        elseif ( $element->hasAttribute('field-optional') )
        {
            $label_content = $label . $this->getOptional();
        }

        // invoke parent and get form label
        return parent::__invoke($element, $label_content, $position);
    }
}
