<?php


namespace Database;

/**
 * Class PDOStatement
 * @package Database
 */
class PDOStatement implements StatementInterface
{

    /**
     * @var \PDOStatement
     */
    private $statement;

    /**
     * PDOStatement constructor.
     * @param \PDOStatement $statement
     */
    public function __construct(\PDOStatement $statement)
    {
        $this->statement = $statement;
    }

    /**
     * @param array $params
     * @return ResultSetInterface
     */
    public function execute(array $params = []): ResultSetInterface
    {
        $this->statement->execute($params);

        return new PDOResultSet($this->statement);
    }
}