<?php


namespace Database\ORM;


abstract class AbstractRepository implements RepositoryInterface
{
    /**
     * @var string
     */
    private $entity;

    /**
     * @var string
     */
    private $table;

    /**
     * @var string
     */
    private $primaryKey;


    /**
     * @var QueryBuilderInterface
     */
    private $queryBuilder;


    /**
     * AbstractRepository constructor.
     * @param string $entity
     * @param string $table
     * @param string $primaryKey
     * @param QueryBuilderInterface $queryBuilder
     */
    public function __construct(string $entity,
                                string $table,
                                string $primaryKey,
                                QueryBuilderInterface $queryBuilder)
    {
        $this->entity = $entity;
        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->queryBuilder = $queryBuilder;
    }


    /**
     * @inheritDoc
     */
    public function findAll(array $orderBy = []): \Generator
    {
        $builder = $this->queryBuilder->select()->from($this->table);

        if (!empty($orderBy)) {
            $builder->orderBy($orderBy);
        }

        return $builder->build()->fetchAll($this->entity);
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $where, array $orderBy = []): \Generator
    {
        $builder = $this->queryBuilder
            ->select()
            ->from($this->table)
            ->where($where)
        ;

        if (!empty($orderBy)) {
            $builder->orderBy($orderBy);
        }

        return $builder->build()->fetchAll($this->entity);
    }

    /**
     * @inheritDoc
     */
    public function findOne(string $primaryKey): object
    {
        $builder = $this->queryBuilder
            ->select()
            ->from($this->table)
            ->where([$this->primaryKey => $primaryKey])
        ;

        return $builder->build()->fetchOne($this->entity);
    }

    /**
     * @param int $id
     * @param array $columns
     * @return object
     */
    public function find(int $id, array $columns = []): object
    {
        $builder = $this->queryBuilder
            ->select($columns)
            ->from($this->table)
            ->where(['id' => $id])
        ;

        var_dump($builder->getQuery());

        return $builder->build()->fetchOne($this->entity);
    }
}