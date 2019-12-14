<?php


namespace App\Repository;


use App\Data\UserDTO;
use Database\ORM\AbstractRepository;
use Database\ORM\QueryBuilderInterface;

class NewUserRepository extends AbstractRepository implements UserRepositoryInterface
{
    public function __construct(QueryBuilderInterface $queryBuilder)
    {
        parent::__construct(UserDTO::class, 'users', 'id', $queryBuilder);
    }

    /**
     * @inheritDoc
     */
    public function insert(UserDTO $userDTO): bool
    {
        // TODO: Implement insert() method.
    }

    /**
     * @inheritDoc
     */
    public function updateProfile(int $id, UserDTO $userDTO): bool
    {
        // TODO: Implement updateProfile() method.
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): bool
    {
        // TODO: Implement delete() method.
    }

    /**
     * @inheritDoc
     */
    public function findByEmail(string $email): ?UserDTO
    {
        // TODO: Implement findByEmail() method.
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): ?UserDTO
    {
        // TODO: Implement findById() method.
    }
}