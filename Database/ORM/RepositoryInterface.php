<?php


namespace Database\ORM;


interface RepositoryInterface
{
    /**
     * @param array $orderBy
     * @return \Generator
     */
    public function findAll(array $orderBy = []): \Generator;

    /**
     * @param array $where
     * @param array $orderBy
     * @return \Generator
     */
    public function findBy(array $where, array $orderBy = []): \Generator;

    /**
     * @param string $primaryKey
     * @return object
     */
    public function findOne(string $primaryKey): object;

    /**
     * @param int $id
     * @param array $columns
     * @return object
     */
    public function find(int $id, array $columns = []): object;
}