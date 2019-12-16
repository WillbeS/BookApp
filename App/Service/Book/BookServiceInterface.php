<?php


namespace App\Service\Book;


use App\Data\BookDTO;

interface BookServiceInterface
{
    /**
     * @param BookDTO $book
     * @return mixed
     */
    public function create(BookDTO $book);

    /**
     * @param BookDTO $book
     * @return mixed
     */
    public function edit(BookDTO $book);

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id);

    /**
     * @param int $limit
     * @return \Generator
     */
    public function getLatest(int $limit): \Generator;

    /**
     * @param int $id
     * @return BookDTO|null
     */
    public function getBookById(int $id): ?BookDTO;

    /**
     * @param int $bookId
     * @param int $userId
     * @return mixed
     */
    public function addBookToUserCollection(int $bookId, int $userId);

    /**
     * @param int $bookId
     * @param int $userId
     * @return mixed
     */
    public function removeBookFromUserCollection(int $bookId, int $userId);

    /**
     * @param $bookId
     * @param $userId
     * @return bool
     */
    public function bookIsInCollection($bookId, $userId): bool;

    /**
     * @param int $userId
     * @return \Generator
     */
    public function getBooksByUser(int $userId): \Generator;
}