<?php

namespace Core;


class DataBinder implements DataBinderInterface
{
    /**
     * @param array $formData
     * @param $object
     */
    public function bind(array $formData, $object)
    {
        try {
            $classInfo = new \ReflectionClass($object);

            foreach ($formData as $name => $value) {
                $nameParts  = explode('_', $name);
                $methodName = 'set';

                foreach ($nameParts as $part) {
                    $methodName .= ucfirst($part);
                }

                if(method_exists($object, $methodName)) {
                    $object->$methodName($value);
                }
            }
        } catch (\ReflectionException $exception) {
            // TODO - some logger
        }
    }


}