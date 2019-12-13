<?php

namespace Core;


interface DataBinderInterface
{
    /**
     * @param array $formData
     * @param $object
     * @return bool
     */
    public function bind(array $formData, $object);
}