<?php

namespace App\Repository\Role;

use App\Data\RoleDTO;
use Database\ORM\AbstractRepository;
use Database\ORM\QueryBuilderInterface;

class RoleRepository extends AbstractRepository implements UsersRolesRepositoryInterface
{
    public function __construct(QueryBuilderInterface $queryBuilder)
    {
        parent::__construct(RoleDTO::class, 'roles', 'id', $queryBuilder);
    }

    public function addRoleToUser(int $userId, int $roleId): bool
    {
        $this->queryBuilder->insert('users_roles', ['user_id' => $userId, 'role_id' => $roleId]);

        return true;
    }

    public function findRolesByUser(int $userId): \Generator
    {
        $query = "SELECT r.id, r.name 
                  FROM users_roles AS ur
                  INNER JOIN roles as r 
                    ON r.id = ur.role_id
                  WHERE user_id = ?";

        return $this->queryBuilder
            ->setQuery($query)
            ->setExecuteParams([$userId])
            ->build()
            ->fetchAll(RoleDTO::class);
    }
}