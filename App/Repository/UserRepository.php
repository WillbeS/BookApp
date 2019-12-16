<?php


namespace App\Repository;


use App\Data\UserDTO;
use Database\ORM\AbstractRepository;
use Database\ORM\QueryBuilderInterface;

/**
 * Class UserRepository
 * @package App\Repository
 */
class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    public function __construct(QueryBuilderInterface $queryBuilder)
    {
        parent::__construct(UserDTO::class, 'users', 'id', $queryBuilder);
    }

    /**
     * @inheritDoc
     */
    public function insert(UserDTO $userDTO): int
    {
        $values = $this->mapObjectPropertiesToColumns($userDTO);

        return $this->queryBuilder->insert($this->table, $values);
    }

    /**
     * @inheritDoc
     */
    public function updateProfile(int $id, UserDTO $userDTO): bool
    {
        $values = $this->mapObjectPropertiesToColumns($userDTO);
        $this->queryBuilder->update($this->table, $values, ['id' => $id]);

        return true;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): bool
    {
        $this->queryBuilder->delete($this->table, ['id' => $id]);

        return true;
    }

    /**
     * @inheritDoc
     */
    public function findByEmail(string $email): ?UserDTO
    {
        return $this->findOneBy(['email' => $email]);
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): ?UserDTO
    {
        return $this->find($id);
    }
}