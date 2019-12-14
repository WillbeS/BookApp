<?php


namespace Database\ORM;


interface RepositoryInterface
{
    /**
     * @param array $columns
     * @param array $orderBy
     * @return \Generator
     */
    public function findAll(array $columns = [], array $orderBy = []): \Generator;

    /**
     * @param array $where
     * @param array $columns
     * @param array $orderBy
     * @return \Generator
     */
    public function findBy(array $where, array $columns = [], array $orderBy = []): \Generator;

    /**
     * @param array $where
     * @param array $columns
     * @return object|null
     */
    public function findOneBy(array $where, array $columns = []): ?object;

    /**
     * @param int $id
     * @param array $columns
     * @return object|null
     */
    public function find(int $id, array $columns = []): ?object;
}