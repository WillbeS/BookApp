<?php


namespace App\Http;


use App\Service\Book\BookService;
use App\Service\Book\BookServiceInterface;
use App\Service\User\UserServiceInterface;
use Core\SessionInterface;
use Core\TemplateInterface;

class HomeController extends AbstractController
{
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

    public function index()
    {
        $latestBooks = $this->bookService->getLatest(10);

        $this->renderWithLayout('home/index', $latestBooks);

    }


}