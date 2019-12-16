<?php


namespace Database\ORM;


use Database\ResultSetInterface;
use Database\StatementInterface;

interface QueryBuilderInterface
{
    public function select(array $columns = []): QueryBuilderInterface;

    public function from(string $table): QueryBuilderInterface;

    public function where(array $criteria = []): QueryBuilderInterface;

    public function orderBy(array $order = []): QueryBuilderInterface;

    public function limit(int $limit = null): QueryBuilderInterface;

    public function build(): ResultSetInterface;

    public function insert(string $table, array $values): int;

    public function update(string $table, array $values, array $where = []): StatementInterface;

    public function delete(string $table, array $where = []): StatementInterface;

    public function getRowsCount(string $table, array $where = []): int;

    public function setQuery(string $query): QueryBuilderInterface;

    public function getQuery(): string;

    public function setExecuteParams(array $params): QueryBuilderInterface;


}