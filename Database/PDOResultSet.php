<?php

namespace Database;

use Generator;

class PDOResultSet implements ResultSetInterface
{
    /**
     * @var \PDOStatement
     */
    private $pdoStatement;


    public function __construct(\PDOStatement $statement)
    {
        $this->pdoStatement = $statement;
    }

    //TODO - delete this when safe
    public function fetch($className): \Generator
    {
        while ($row = $this->pdoStatement->fetchObject($className)) {
            yield $row;
        }
    }

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
    public function fetchOne(string $className): object
    {
        return $this->pdoStatement->fetchObject($className);
    }
}