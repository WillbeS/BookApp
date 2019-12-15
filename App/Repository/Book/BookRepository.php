<?php


namespace App\Repository\Book;


use App\Data\BookDTO;
use Database\ORM\AbstractRepository;
use Database\ORM\QueryBuilderInterface;

class BookRepository extends AbstractRepository implements BookRepositoryInterface
{
    public function __construct(QueryBuilderInterface $queryBuilder)
    {
        parent::__construct(BookDTO::class, 'books', 'id', $queryBuilder);
    }

    public function insert(BookDTO $book): int
    {
        $values = $this->mapObjectPropertiesToColumns($book);

        return $this->queryBuilder->insert($this->table, $values);
    }

    public function update(BookDTO $book)
    {
        $values = $this->mapObjectPropertiesToColumns($book);

        $this->queryBuilder->update($this->table, $values, ['id' => $book->getId()]);
    }

    public function delete(int $id)
    {
        $this->queryBuilder->delete($this->table, ['id' => $id]);
    }
}