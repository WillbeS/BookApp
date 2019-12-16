<?php


namespace Database\ORM;


use Database\DatabaseInterface;
use Database\ResultSetInterface;
use Database\StatementInterface;

/**
 * Class MySQLQueryBuilder
 * @package Database\ORM
 */
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

    /**
     * @param array $columns
     * @return QueryBuilderInterface
     */
    public function select(array $columns = []): QueryBuilderInterface
    {
        $query = 'SELECT ';

        if (empty($columns)) {
            $query .= '*';
        } else {
            $mappedColumns = $this->mapColumnsToProperties($columns);
            $query .= implode(', ', $mappedColumns);
        }

        $this->query = $query;

        return $this;
    }

    /**
     * @param string $table
     * @return QueryBuilderInterface
     */
    public function from(string $table): QueryBuilderInterface
    {
        $this->query .= ' FROM ' . $table;

        return $this;
    }

    /**
     * @param array $criteria
     * @return QueryBuilderInterface
     */
    public function where(array $criteria = []): QueryBuilderInterface
    {
        $query = $this->addWhereToQuery($criteria);

        $this->query .= $query;

        $this->executeParams = array_values($criteria);

        return $this;
    }

    /**
     * @param array $order
     * @return QueryBuilderInterface
     */
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
        //TODO
    }


    /**
     * @param string $query
     * @return QueryBuilderInterface
     */
    public function setQuery(string $query): QueryBuilderInterface
    {
        $this->query = $query;

        return $this;
    }

    /**
     * @param array $params
     * @return QueryBuilderInterface
     */
    public function setExecuteParams(array $params): QueryBuilderInterface
    {
        $this->executeParams = $params;

        return $this;
    }

    /**
     * @return ResultSetInterface
     */
    public function build(): ResultSetInterface
    {
        return $this->db->query($this->query)->execute($this->executeParams);
    }

    /**
     * @param string $table
     * @param array $values
     * @return int
     */
    public function insert(string $table, array $values): int
    {
        $query = 'INSERT INTO ' . $table
                . ' (' . implode(', ', array_keys($values)) . ')'
                . ' VALUES '
                . '(' . implode(', ', array_fill(0, count($values), '?')) . ')'
        ;

        $stm = $this->db->query($query);
        $stm->execute(array_values($values));

        return $this->db->getLastInsertId();
    }

    /**
     * @param string $table
     * @param array $values
     * @param array $where
     * @return StatementInterface
     */
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

    /**
     * @param string $table
     * @param array $where
     * @return StatementInterface
     */
    public function delete(string $table, array $where = []): StatementInterface
    {
        $query = 'DELETE FROM ' . $table . $this->addWhereToQuery($where);

        var_dump($query);

        $stmt = $this->db->query($query);
        $stmt->execute(array_values($where));

        return $stmt;
    }

    /**
     * @param string $table
     * @param array $where
     * @return int
     */
    public function getRowsCount(string $table, array $where = []): int
    {
        $query = 'SELECT COUNT(*) FROM ' . $table . $this->addWhereToQuery($where);
        $stmt = $this->db->query($query);
        $resultSet = $stmt->execute(array_values($where));

        return $resultSet->fetchColumn();
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @param array $criteria
     * @return string
     */
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

    /**
     * @param array $columns
     * @return array
     */
    private function mapColumnsToProperties(array $columns): array
    {
        $properties = [];

        foreach ($columns as $column) {
            $parts = explode('_', $column);
            $property = array_shift($parts);

            foreach ($parts as $part) {
                $property .= ucfirst($part);
            }

            $properties[] = $column . ' AS ' . $property;
        }

        return $properties;
    }
}