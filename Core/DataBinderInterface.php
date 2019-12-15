<?php

namespace Core;


interface DataBinderInterface
{
    /**
     * @param array $formData
     * @param $object
     * @return array
     */
    public function bind(array $formData, $object): array;
}