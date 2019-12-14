<?php

namespace Database;

use Generator;

interface ResultSetInterface
{
    public function fetch($className):Generator;

    /**
     * @param string $className
     * @return Generator
     */
    public function fetchAll(string $className): \Generator;

    /**
     * @param string $className
     * @return object
     */
    public function fetchOne(string $className): object;
}