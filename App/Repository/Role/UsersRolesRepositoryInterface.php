<?php


namespace App\Repository\Role;


use Database\ORM\RepositoryInterface;

/**
 * Interface UsersRolesRepositoryInterface
 * @package App\Repository\Role
 */
interface UsersRolesRepositoryInterface extends RepositoryInterface
{
    /**
     * @param int $userId
     * @param int $roleId
     * @return bool
     */
    public function addRoleToUser(int $userId, int $roleId): bool;

    /**
     * @param int $userId
     * @return \Generator
     */
    public function findRolesByUser(int $userId): \Generator;
}