<?php

namespace Database\ORM;


use ReflectionProperty;

/**
 * Class AbstractRepository
 * @package Database\ORM
 */
abstract class AbstractRepository implements RepositoryInterface
{
    /**
     * @var string
     */
    protected $entity;

    /**
     * @var string
     */
    protected $table;

    /**
     * @var string
     */
    protected $primaryKey;


    /**
     * @var QueryBuilderInterface
     */
    protected $queryBuilder;


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
    public function findAll(array $columns = [], array $orderBy = []): \Generator
    {
        if (empty($columns)) {
            $columns = $this->getAllColumns();
        }

        $builder = $this->queryBuilder->select($columns)->from($this->table);

        if (!empty($orderBy)) {
            $builder->orderBy($orderBy);
        }

        return $builder->build()->fetchAll($this->entity);
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $where, array $columns = [], array $orderBy = []): \Generator
    {
        if (empty($columns)) {
            $columns = $this->getAllColumns();
        }

        $builder = $this->queryBuilder
            ->select($columns)
            ->from($this->table)
            ->where($where)
        ;

        if (!empty($orderBy)) {
            $builder->orderBy($orderBy);
        }

        return $builder->build()->fetchAll($this->entity);
    }

    /**
     * @param array $where
     * @param array $columns
     * @return object|null
     */
    public function findOneBy(array $where, array $columns = []): ?object
    {
        if (empty($columns)) {
            $columns = $this->getAllColumns();
        }

        $builder = $this->queryBuilder
            ->select($columns)
            ->from($this->table)
            ->where($where)
        ;

        return $builder->build()->fetchOne($this->entity);
    }

    /**
     * @param int $id
     * @param array $columns
     * @return object|null
     */
    public function find(int $id, array $columns = []): ?object
    {
        if (empty($columns)) {
            $columns = $this->getAllColumns();
        }

        $builder = $this->queryBuilder
            ->select($columns)
            ->from($this->table)
            ->where(['id' => $id])
        ;

        return $builder->build()->fetchOne($this->entity);
    }

    /**
     * @return array
     */
    protected function getAllColumns(): array
    {
        $columns = [];

        try {
            $classInfo = new \ReflectionClass($this->entity);

            $properties = $classInfo->getProperties();

            foreach ($properties as $property) {
                $propName = $property->getName();

                $pieces = preg_split('/(?=[A-Z])/',$propName);

                $column = implode('_', array_map(function ($el) {
                    return strtolower($el);
                }, $pieces));


                $columns[] = $column;
            }

        } catch (\ReflectionException $exception) {
            // TODO - some logger
        }

        return $columns;
    }

    /**
     * @param object $object
     * @param bool $skipId
     * @return array
     */
    protected function mapObjectPropertiesToColumns(object $object, bool $skipId = true): array
    {
        $columns = [];

        try {
            $classInfo = new \ReflectionClass($object);

            $properties = $classInfo->getProperties();

            foreach ($properties as $property) {
                $propName = $property->getName();

                if ($skipId && 'id' === $propName) {
                    continue;
                }

                $pieces = preg_split('/(?=[A-Z])/',$propName);

                $column = implode('_', array_map(function ($el) {
                    return strtolower($el);
                }, $pieces));

                $getter = $this->getPropertyValue($property, $object);

                $columns[$column] = $this->getPropertyValue($property, $object);
            }

        } catch (\ReflectionException $exception) {
            // TODO - some logger
        }

        return $columns;
    }

    /**
     * @param ReflectionProperty $property
     * @param object $object
     * @return string|null
     */
    private function getPropertyValue(ReflectionProperty $property, object $object): ?string
    {
        $getter = 'get' . ucfirst($property->getName());
        $boolGetter = 'is' . ucfirst($property->getName());

        if(method_exists($object, $getter)) {
            return $object->$getter();
        } elseif(method_exists($object, $boolGetter)) {
            return (string)(int)$object->$boolGetter();
        }
    }
}