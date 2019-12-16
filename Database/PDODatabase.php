<?php

namespace Database;

use PDO;

/**
 * Class PDODatabase
 * @package Database
 */
class PDODatabase implements DatabaseInterface
{
    /**
     * @var \PDO;
     */
    private $pdo;

    /**
     * PDODatabase constructor.
     * @param string $host
     * @param string $db
     * @param string $user
     * @param string $pass
     * @param string $charset
     */
    public function __construct(string $host,
                                string $db,
                                string $user,
                                string $pass,
                                string $charset = 'utf8')
    {
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $this->connect($dsn, $user, $pass, $options);
    }

    /**
     * @param $dsn
     * @param $user
     * @param $pass
     * @param $options
     */
    private function connect($dsn, $user, $pass, $options)
    {
        try {
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * @param string $query
     * @return StatementInterface
     */
    public function query(string $query): StatementInterface
    {
        $stmt = $this->pdo->prepare($query);
        return new PDOStatement($stmt);
    }

    /**
     * @return int
     */
    public function getLastInsertId(): int
    {
        return $this->pdo->lastInsertId();
    }
}