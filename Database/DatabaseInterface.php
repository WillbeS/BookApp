<?php


namespace Database;

/**
 * Interface DatabaseInterface
 * @package Database
 */
interface DatabaseInterface
{
    /**
     * @param string $query
     * @return StatementInterface
     */
    public function query(string $query): StatementInterface;

    /**
     * @return int
     */
    public function getLastInsertId(): int;
}