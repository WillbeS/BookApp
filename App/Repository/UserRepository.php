<?php


namespace App\Repository;


use App\Data\UserDTO;
use Database\DatabaseInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var DatabaseInterface
     */
    private $db;


    public function __construct(DatabaseInterface $database)
    {
        $this->db = $database;
    }

    /**
     * @inheritDoc
     */
    public function insert(UserDTO $userDTO): bool
    {
        $this->db->query(
            "
                    INSERT INTO users (first_name, last_name, email, password, active) 
                    VALUES (? , ?, ?, ?, ?)
            "
        )->execute(
            [
                $userDTO->getFirstName(),
                $userDTO->getLastName(),
                $userDTO->getEmail(),
                $userDTO->getPassword(),
                $userDTO->isActive(),
            ]
        );

        return true;
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, UserDTO $userDTO): bool
    {
        $this->db->query(
            "
                UPDATE users
                SET 
                    first_name = ?,
                    last_name = ?,
                    email = ?, 
                    password = ?,
                    active = ? 
                WHERE id = ?
            "
        )->execute([
            $userDTO->getFirstName(),
            $userDTO->getLastName(),
            $userDTO->getEmail(),
            $userDTO->getPassword(),
            $userDTO->isActive(),
            $id
        ]);

        return true;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): bool
    {
        $this->db->query(
            "DELETE FROM users WHERE id = ?"
        )->execute([
            $id
        ]);

        return true;
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): ?UserDTO
    {
        return $this->db->query(
            "
                        SELECT id, first_name, last_name, email, password, active 
                        FROM users
                        WHERE id = ?
                "
        )->execute([$id])->fetch(UserDTO::class)->current();
    }

    /**
     * @inheritDoc
     */
    public function findByEmail(string $email): ?UserDTO
    {
        return $this->db->query(
                "
                        SELECT id, first_name, last_name, email, password, active 
                        FROM users
                        WHERE email = ?
                "
        )->execute([$email])
            ->fetch(UserDTO::class)
            ->current();
    }

    /**
     * @inheritDoc
     */
    public function findAll(): \Generator
    {
        return $this->db->query(
            "
                        SELECT id, first_name, last_name, email, password, active 
                        FROM users
                "
        )->execute()
            ->fetch(UserDTO::class);
    }
}