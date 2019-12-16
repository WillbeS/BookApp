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

    /**
     * @param BookDTO $book
     * @return int
     */
    public function insert(BookDTO $book): int
    {
        $values = $this->mapObjectPropertiesToColumns($book);

        return $this->queryBuilder->insert($this->table, $values);
    }

    /**
     * @param BookDTO $book
     * @return mixed|void
     */
    public function update(BookDTO $book)
    {
        $values = $this->mapObjectPropertiesToColumns($book);

        $this->queryBuilder->update($this->table, $values, ['id' => $book->getId()]);
    }

    /**
     * @param int $id
     * @return mixed|void
     */
    public function delete(int $id)
    {
        $this->queryBuilder->delete($this->table, ['id' => $id]);
    }

    /**
     * @inheritDoc
     */
    public function addBookToCollection(int $bookId, int $userId): bool
    {
        $this->queryBuilder->insert('users_books', ['user_id' => $userId, 'book_id' => $bookId]);

        return true;
    }

    /**
     * @inheritDoc
     */
    public function removeBookFromCollection(int $bookId, int $userId): bool
    {
        $this->queryBuilder->delete('users_books', ['user_id' => $userId, 'book_id' => $bookId]);

        return true;
    }

    /**
     * @inheritDoc
     */
    public function getCountByUserAndBook(int $bookId, int $userId): int
    {

        return $this->queryBuilder->getRowsCount('users_books', ['user_id' => $userId, 'book_id' => $bookId]);
    }

    /**
     * @param int $userId
     * @return \Generator
     */
    public function findBooksByUser(int $userId): \Generator
    {
        $query = "SELECT b.id, b.name, b.isbn, b.description, b.image 
                  FROM users_books AS ub
                  INNER JOIN books as b 
                    ON b.id = ub.book_id
                  WHERE user_id = ?";

        return $this->queryBuilder
            ->setQuery($query)
            ->setExecuteParams([$userId])
            ->build()
            ->fetchAll(BookDTO::class);
    }
}