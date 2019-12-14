<?php


namespace App\Repository\Role;


use Database\ORM\RepositoryInterface;

interface UsersRolesRepositoryInterface extends RepositoryInterface
{
    public function addRoleToUser(int $userId, int $roleId): bool;

    public function findRolesByUser(int $userId): \Generator;
}