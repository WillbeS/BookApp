<?php


namespace Database\ORM;


use Database\DatabaseInterface;
use Database\ResultSetInterface;
use Database\StatementInterface;

class MySQLQueryBuilder implements QueryBuilderInterface
{
    /**
     * @var string
     */
    private $query;

    /**
     * @var array
     */
    private $executeParams;

    /**
     * @var DatabaseInterface
     */
    private $db;

    /**
     * MySQLQueryBuilder constructor.
     * @param DatabaseInterface $database
     */
    public function __construct(DatabaseInterface $database)
    {
        $this->db = $database;
        $this->query = '';
        $this->executeParams = [];
    }


    public function select(array $columns = []): QueryBuilderInterface
    {
        $query = 'SELECT ';

        if (empty($columns)) {
            $query .= '*';
        } else {
            $query .= implode(', ', $columns);
        }

        $this->query = $query;

        return $this;
    }

    public function from(string $table): QueryBuilderInterface
    {
        $this->query .= ' FROM ' . $table;

        return $this;
    }

    public function where(array $criteria = []): QueryBuilderInterface
    {
        $query = ' WHERE 1=1';

        foreach (array_keys($criteria) as $column) {
            $query .= ' AND ' . $column . ' = ?';
        }

        $this->query .= $query;
        $this->executeParams = array_values($criteria);

        return $this;
    }

    public function orderBy(array $order = []): QueryBuilderInterface
    {
        $query = ' ORDER BY ';

        foreach ($order as $column => $criteria) {
            $query .= $column . ' ' . $criteria . ', ';
        }

        $query = rtrim($query, ', ');
        $this->query .= $query;

        return $this;
    }

    public function limit(int $limit = null): QueryBuilderInterface
    {
        //TODO - ricky because of that int shit
    }

    public function build(): ResultSetInterface
    {
        var_dump($this->executeParams);
        return $this->db->query($this->query)->execute($this->executeParams);
    }

    public function insert(string $table, array $values): StatementInterface
    {
        $query = 'INSERT INTO ' . $table
                . ' (' . implode(', ', array_keys($values)) . ')'
                . ' VALUES '
                . '(' . implode(', ', array_fill(0, count($values), '?')) . ')'
        ;

        $stm = $this->db->query($query);
        $stm->execute(array_values($values));

        return $stm;
    }

    public function update(string $table, array $values, array $where = []): StatementInterface
    {
        $query = 'UPDATE ' . $table . ' SET ';

        foreach (array_keys($values) as $column) {
            $query .= $column . ' = ?, ';
        }

        $query = rtrim($query, ', ');
        $query .= $this->addWhereToQuery($where);

        $stmt = $this->db->query($query);
        $stmt->execute(array_merge(array_values($values), array_values($where)));

        return $stmt;
    }

    public function delete(string $table, array $where = []): StatementInterface
    {
        $query = 'DELETE FROM ' . $table . $this->addWhereToQuery($where);


        $stmt = $this->db->query($query);
        $stmt->execute(array_values($where));

        return $stmt;
    }

    private function addWhereToQuery(array $criteria): string
    {
        if (count($criteria) < 1) {
            return '';
        }

        $keys = array_keys($criteria);

        $query = ' WHERE ' . array_shift($keys) . ' = ?';

        foreach ($keys as $column) {
            $query .= ' AND ' . $column . ' = ?';
        }

        return $query;
    }
}