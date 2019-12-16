<?php


namespace Database;

/**
 * Interface StatementInterface
 * @package Database
 */
interface StatementInterface
{
    /**
     * @param array $params
     * @return ResultSetInterface
     */
    public function execute(array $params = []): ResultSetInterface;
}