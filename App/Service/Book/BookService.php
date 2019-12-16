<?php


namespace App\Service\Book;


use App\Data\BookDTO;
use App\Repository\Book\BookRepositoryInterface;
use Core\Exception\AppException;

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


    /**
     * @param BookDTO $book
     * @throws AppException
     */
    public function create(BookDTO $book)
    {
        try {
            $this->bookRepository->insert($book);
        } catch (\PDOException $exception) {
            throw new AppException('Already have a book with this ISBN.');
        }

    }

    /**
     * @param BookDTO $book
     * @throws AppException
     */
    public function edit(BookDTO $book)
    {
        try {
            $this->bookRepository->update($book);
        } catch (\PDOException $exception) {
            throw new AppException('Already have a book with this ISBN.');
        }
    }

    /**
     * @param int $id
     * @throws AppException
     */
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

    /**
     * @param int $bookId
     * @param int $userId
     * @return mixed|void
     * @throws AppException
     */
    public function addBookToUserCollection(int $bookId, int $userId)
    {
        if ($this->bookIsInCollection($bookId, $userId)) {
            throw new AppException('The book is already added to your collection.');
        }

        $this->bookRepository->addBookToCollection($bookId, $userId);
    }

    public function removeBookFromUserCollection(int $bookId, int $userId)
    {
        $this->bookRepository->removeBookFromCollection($bookId, $userId);
    }

    public function bookIsInCollection($bookId, $userId): bool
    {
        return $this->bookRepository->getCountByUserAndBook($bookId, $userId) > 0;
    }

    /**
     * @inheritDoc
     */
    public function getBooksByUser(int $userId): \Generator
    {
        return $this->bookRepository->findBooksByUser($userId);
    }
}