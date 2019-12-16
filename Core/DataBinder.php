<?php

namespace Core;


use Core\Exception\AppException;
use Core\Exception\FormValidationException;

/**
 * Class DataBinder
 * @package Core
 */
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

    /**
     * @param array $formData
     * @param $object
     * @throws AppException
     */
    public function bindFormDataWithValidation(array $formData, $object)
    {
        $validationErrors = $this->bind($formData, $object);

        if (count($validationErrors ) > 0) {
            $message = "You have validation errors in your form: \n" . implode("\n", $validationErrors);
            throw new AppException($message);
        }
    }

}