<?php

namespace Core;


use App\Exception\AppException;
use App\Exception\FormValidationException;

class DataBinder implements DataBinderInterface
{
    /**
     * @param array $formData
     * @param $object
     * @return array
     * @throws AppException
     */
    public function bind(array $formData, $object): array
    {
        $errors = [];

        try {
            $classInfo = new \ReflectionClass($object);

            foreach ($formData as $name => $value) {
                $nameParts  = explode('_', $name);
                $methodName = 'set';

                foreach ($nameParts as $part) {
                    $methodName .= ucfirst($part);
                }

                if(method_exists($object, $methodName)) {
                    try {
                        $object->$methodName($value);
                    } catch (FormValidationException $exception) {
                        $errors[] = $exception->getMessage();
                    }
                }
            }
        } catch (\ReflectionException $exception) {
            throw new AppException();
        }

        return $errors;
    }


}