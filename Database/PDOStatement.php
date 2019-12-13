<?php


namespace Database;


class PDOStatement implements StatementInterface
{

    /**
     * @var \PDOStatement
     */
    private $statement;

    public function __construct(\PDOStatement $statement)
    {
        $this->statement = $statement;
    }

    public function execute(array $params = []): ResultSetInterface
    {
        $this->statement->execute($params);
        return new PDOResultSet($this->statement);
    }
}