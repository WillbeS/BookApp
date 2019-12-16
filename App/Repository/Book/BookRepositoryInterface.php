<?php

namespace App\Repository\Book;

use App\Data\BookDTO;
use Database\ORM\RepositoryInterface;

interface BookRepositoryInterface extends RepositoryInterface
{
    /**
     * @param BookDTO $book
     * @return int
     */
    public function insert(BookDTO $book): int;

    /**
     * @param BookDTO $book
     * @return mixed
     */
    public function update(BookDTO $book);

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id);

    /**
     * @param int $bookId
     * @param int $userId
     * @return mixed
     */
    public function addBookToCollection(int $bookId, int $userId): bool;

    /**
     * @param int $bookId
     * @param int $userId
     * @return bool
     */
    public function removeBookFromCollection(int $bookId, int $userId): bool;

    /**
     * @param int $bookId
     * @param int $userId
     * @return int
     */
    public function getCountByUserAndBook(int $bookId, int $userId): int;

    /**
     * @param int $userId
     * @return \Generator
     */
    public function findBooksByUser(int $userId): \Generator;
}