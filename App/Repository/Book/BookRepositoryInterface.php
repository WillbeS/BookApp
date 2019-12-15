<?php

namespace App\Repository\Book;

use App\Data\BookDTO;
use Database\ORM\RepositoryInterface;

interface BookRepositoryInterface extends RepositoryInterface
{
    public function insert(BookDTO $book): int;

    public function update(BookDTO $book);

    public function delete(int $id);
}