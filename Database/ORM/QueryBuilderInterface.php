<?php


namespace Database\ORM;


use Database\ResultSetInterface;
use Database\StatementInterface;

/**
 * Interface QueryBuilderInterface
 * @package Database\ORM
 */
interface QueryBuilderInterface
{
    /**
     * @param array $columns
     * @return QueryBuilderInterface
     */
    public function select(array $columns = []): QueryBuilderInterface;

    /**
     * @param string $table
     * @return QueryBuilderInterface
     */
    public function from(string $table): QueryBuilderInterface;

    /**
     * @param array $criteria
     * @return QueryBuilderInterface
     */
    public function where(array $criteria = []): QueryBuilderInterface;

    /**
     * @param array $order
     * @return QueryBuilderInterface
     */
    public function orderBy(array $order = []): QueryBuilderInterface;

    /**
     * @param int|null $limit
     * @return QueryBuilderInterface
     */
    public function limit(int $limit = null): QueryBuilderInterface;

    /**
     * @return ResultSetInterface
     */
    public function build(): ResultSetInterface;

    /**
     * @param string $table
     * @param array $values
     * @return int
     */
    public function insert(string $table, array $values): int;

    /**
     * @param string $table
     * @param array $values
     * @param array $where
     * @return StatementInterface
     */
    public function update(string $table, array $values, array $where = []): StatementInterface;

    /**
     * @param string $table
     * @param array $where
     * @return StatementInterface
     */
    public function delete(string $table, array $where = []): StatementInterface;

    /**
     * @param string $table
     * @param array $where
     * @return int
     */
    public function getRowsCount(string $table, array $where = []): int;

    /**
     * @param string $query
     * @return QueryBuilderInterface
     */
    public function setQuery(string $query): QueryBuilderInterface;

    /**
     * @return string
     */
    public function getQuery(): string;

    /**
     * @param array $params
     * @return QueryBuilderInterface
     */
    public function setExecuteParams(array $params): QueryBuilderInterface;


}