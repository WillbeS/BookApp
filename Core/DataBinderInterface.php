<?php

namespace Core;

/**
 * Interface DataBinderInterface
 * @package Core
 */
interface DataBinderInterface
{
    /**
     * @param array $formData
     * @param $object
     * @return array
     */
    public function bind(array $formData, $object): array;

    /**
     * @param array $formData
     * @param $object
     * @return mixed
     */
    public function bindFormDataWithValidation(array $formData, $object);
}