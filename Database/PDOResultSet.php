<?php

namespace Database;

use Generator;

/**
 * Class PDOResultSet
 * @package Database
 */
class PDOResultSet implements ResultSetInterface
{
    /**
     * @var \PDOStatement
     */
    private $pdoStatement;


    /**
     * PDOResultSet constructor.
     * @param \PDOStatement $statement
     */
    public function __construct(\PDOStatement $statement)
    {
        $this->pdoStatement = $statement;
    }

//    public function fetch($className): \Generator
//    {
//        while ($row = $this->pdoStatement->fetchObject($className)) {
//            yield $row;
//        }
//    }

    /**
     * @inheritDoc
     */
    public function fetchAll(string $className): \Generator
    {
        while ($row = $this->pdoStatement->fetchObject($className)) {
            yield $row;
        }
    }

    /**
     * @inheritDoc
     */
    public function fetchOne(string $className): ?object
    {
        $result = $this->pdoStatement->fetchObject($className);

        return $result ? $result : null;
    }

    /**
     * @inheritDoc
     */
    public function fetchColumn(): int
    {
        $result = $this->pdoStatement->fetchColumn();

        return $result ? $result : 0;
    }
}