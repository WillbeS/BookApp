<?php


namespace App\Service\Book;


use App\Data\BookDTO;
use App\Exception\AppException;
use App\Repository\Book\BookRepositoryInterface;

class BookService implements BookServiceInterface
{
    /**
     * @var BookRepositoryInterface
     */
    private $bookRepository;

    /**
     * BookService constructor.
     * @param BookRepositoryInterface $bookRepository
     */
    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }


    public function create(BookDTO $book)
    {
        try {
            $this->bookRepository->insert($book);
        } catch (\PDOException $exception) {
            throw new AppException('Already have a book with this ISBN.');
        }

    }

    public function edit(BookDTO $book)
    {
        try {
            $this->bookRepository->update($book);
        } catch (\PDOException $exception) {
            throw new AppException('Already have a book with this ISBN.');
        }
    }

    public function delete(int $id)
    {
        try {
            $this->bookRepository->delete($id);
        } catch (\PDOException $exception) {
            throw new AppException('Something went wrong. The book was not deleted.');
        }
    }

    public function getLatest(int $limit): \Generator
    {
        return $this->bookRepository->findAll();
    }

    public function getBookById(int $id): ?BookDTO
    {
        /** @var BookDTO $book */
        $book = $this->bookRepository->find($id);

        return $book;
    }
}