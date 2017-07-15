<?php

namespace Application\Model;

use DomainException;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

abstract class Entity implements InputFilterAwareInterface
{
    protected $inputFilter;

    // given a data array of $key=>$value pairs, populate properties of $this
    // where the names are given by the $key values, and the values of those
    // properties are given by the $value values
    //
    // Zend\Stdlib\Hydrator\ArraySerializable expects this method to be present
    // for object hydration
    public function exchangeArray(array $data)
    {
        foreach($data as $key=>$value)
        {
            $this->$key = ! empty($value) ? $value : null;
        }
    }

    // create a data array of $key=>$value pairs based on the properties of
    // this object.  Only fields of $this are included, and not any ancestors
    //
    // Zend\Stdlib\Hydrator\ArraySerializable expects this method to be present
    // for object hydration
    public function getArrayCopy()
    {
        $ref = new \ReflectionClass($this);
        $props = $ref->getProperties();
        $props = array_filter(
            $props,
            function($x) { return $x->class == get_class($this); });

        $ret = [];
        foreach($props as $prop)
        {
            $key = $prop->name;
            $value = $this->$key;
            if ( ! is_null($value) )
            {
                $ret[$key] = $value;
            }
        }

        return $ret;
    }

    // Required by InputFilterAwareInterface
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new DomainException(sprintf(
            '%s does not allow injection of an alternate input filter',
            __CLASS__
        ));
    }

    // Required by InputFilterAwareInterface.  This should be overwritten in
    // classes that extend this one
    public function getInputFilter()
    {
        if ($this->inputFilter) {
            return $this->inputFilter;
        }

        return new InputFilter();
    }
}
