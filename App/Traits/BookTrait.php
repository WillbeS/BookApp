<?php


namespace App\Traits;


use App\Data\BookDTO;

trait BookTrait
{
    private function getBookFromRequestData(array $getData): BookDTO
    {
        if (!isset($getData['id'])) {
            $this->addFlashError('Invalid url.');
            $this->redirect('index.php');
        }

        $book = $this->bookService->getBookById($getData['id']);

        if (null == $book) {
            $this->addFlashError('Invalid url');
            $this->redirect('index.php');
        }

        return $book;
    }
}