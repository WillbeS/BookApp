<?php


namespace App\Http;

use App\Data\Template\BookDetailsData;
use App\Service\Book\BookServiceInterface;
use App\Traits\BookTrait;
use Core\Exception\AppException;
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
        $bookDetailsData = (new BookDetailsData())
            ->setBook($book)
            ->setInCurrentUserCollection($this->bookService->bookIsInCollection($book->getId(), $this->session->getUserId()));

        $this->renderWithLayout('book/view_one', $bookDetailsData);
    }

    public function listByUser()
    {
        $this->checkLoggedIn();
        $books = $this->bookService->getBooksByUser($this->session->getUserId());

        $this->renderWithLayout('book/list_by_user', $books);
    }

    public function addToFavorite(array $getData)
    {
        $this->checkLoggedIn();

        try {
            $book = $this->getBookFromRequestData($getData);
            $this->bookService->addBookToUserCollection($book->getId(), $this->session->getUserId());
        } catch (AppException $exception) {
            $this->addFlashError($exception->getMessage());
        } catch (\PDOException $exception) {
            $this->addFlashError('Something went wrong. Please try again later.');
//            var_dump($exception->getMessage());
//            exit;
        }

        $this->redirect('my-books.php');
    }

    public function removeFromFavorite(array $getData)
    {
        $this->checkLoggedIn();

        try {
            $book = $this->getBookFromRequestData($getData);
            $this->bookService->removeBookFromUserCollection($book->getId(), $this->session->getUserId());
        } catch (\PDOException $exception) {
            $this->addFlashError('Something went wrong. Please try again later.');
        }

        $this->redirect('my-books.php');
    }

    private function checkLoggedIn()
    {
        if (null === $this->session->getUserId()) {
            $this->redirect('login.php');
        }
    }
}