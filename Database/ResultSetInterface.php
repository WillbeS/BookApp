<?php

namespace Database;

use Generator;

/**
 * Interface ResultSetInterface
 * @package Database
 */
interface ResultSetInterface
{
//    public function fetch($className):Generator;

    /**
     * @param string $className
     * @return Generator
     */
    public function fetchAll(string $className): \Generator;

    /**
     * @param string $className
     * @return object
     */
    public function fetchOne(string $className): ?object;

    /**
     * @return int
     */
    public function fetchColumn(): int;
}