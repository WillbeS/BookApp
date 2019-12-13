<?php


namespace App\Repository;


use App\Data\UserDTO;

interface UserRepositoryInterface
{
    /**
     * @param UserDTO $userDTO
     * @return bool
     */
    public function insert(UserDTO $userDTO): bool;

    /**
     * @param int $id
     * @param UserDTO $userDTO
     * @return bool
     */
    public function update(int $id, UserDTO $userDTO): bool;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * @param int $id
     * @return UserDTO|null
     */
    public function findById(int $id): ?UserDTO;

    /**
     * @param string $email
     * @return UserDTO|null
     */
    public function findByEmail(string $email): ?UserDTO;

    /**
     * @return \Generator
     */
    public function findAll(): \Generator;
}