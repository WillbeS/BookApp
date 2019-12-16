<?php


namespace App\Data\Template;


use App\Data\BookDTO;

class BookDetailsData
{
    /**
     * @var BookDTO
     */
    private $book;

    /**
     * @var bool
     */
    private $inCurrentUserCollection;

    /**
     * @return BookDTO
     */
    public function getBook(): BookDTO
    {
        return $this->book;
    }

    /**
     * @param BookDTO $book
     * @return BookDetailsData
     */
    public function setBook(BookDTO $book): BookDetailsData
    {
        $this->book = $book;

        return $this;
    }

    /**
     * @return bool
     */
    public function isInCurrentUserCollection(): bool
    {
        return $this->inCurrentUserCollection;
    }

    /**
     * @param bool $inCurrentUserCollection
     * @return BookDetailsData
     */
    public function setInCurrentUserCollection(bool $inCurrentUserCollection): BookDetailsData
    {
        $this->inCurrentUserCollection = $inCurrentUserCollection;

        return $this;
    }
}