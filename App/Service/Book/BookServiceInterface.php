<?php


namespace App\Service\Book;


use App\Data\BookDTO;

interface BookServiceInterface
{
    public function create(BookDTO $book);

    public function edit(BookDTO $book);

    public function delete(int $id);

    public function getLatest(int $limit): \Generator;

    public function getBookById(int $id): ?BookDTO;
}