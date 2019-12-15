<?php


namespace App\Http;

use App\Service\Book\BookServiceInterface;
use App\Traits\BookTrait;
use Core\SessionInterface;
use Core\TemplateInterface;

class BookController extends AbstractController
{
    use BookTrait;

    /**
     * @var BookServiceInterface
     */
    private $bookService;

    public function __construct(TemplateInterface $template,
                                SessionInterface $session,
                                BookServiceInterface $bookService)
    {
        parent::__construct($template, $session);

        $this->bookService = $bookService;
    }

    public function viewOne(array $getData)
    {
        $book = $this->getBookFromRequestData($getData);

        $this->renderWithLayout('book/view_one', $book);
    }


}