<?php


namespace App\Http;


use App\Data\BookDTO;
use App\Exception\AppException;
use App\Service\Book\BookServiceInterface;
use Core\DataBinderInterface;
use Core\SessionInterface;
use Core\TemplateInterface;

class AdminController extends AbstractController
{
    /**
     * @var BookServiceInterface
     */
    private $bookService;

    /**
     * @var DataBinderInterface
     */
    private $dataBinder;


    public function __construct(TemplateInterface $template,
                                SessionInterface $session,
                                BookServiceInterface $bookService,
                                DataBinderInterface $dataBinder)
    {
        parent::__construct($template, $session);

        $this->bookService = $bookService;
        $this->dataBinder = $dataBinder;
    }


    public function createBook(array $formData)
    {
        $this->checkRights();

        $book = new BookDTO();

        if (isset($formData['create'])) {
            try {
                $this->handleCreateProcess($formData, $book);
                $this->addFlashMessage('Book successfully created');
                $this->redirect('index.php');
            } catch (AppException $exception) {
                $this->addFlashError($exception->getMessage());
                $this->renderWithLayout('admin/book/create', $book);
            }
        } else {
            $this->renderWithLayout('admin/book/create', $book);
        }
    }

    public function editBook(array  $getData, array $formData)
    {
        $this->checkRights();

        $book = $this->getBookFromRequestData($getData);

        if (isset($formData['edit'])) {
            try {
                $this->handleEditProcess($formData, $book);
                $this->addFlashMessage('Book successfully edited');
                $this->redirect('index.php');
            } catch (AppException $exception) {
                $this->addFlashError($exception->getMessage());
                $this->renderWithLayout('admin/book/edit', $book);
            }
        } else {
            $this->renderWithLayout('admin/book/edit', $book);
        }
    }

    public function deleteBook(array  $getData)
    {
        $this->checkRights();

        $book = $this->getBookFromRequestData($getData);

        try {
            $this->bookService->delete($book->getId());
            $this->addFlashMessage('Book successfully deleted');
        } catch (AppException $exception) {
            $this->addFlashError($exception->getMessage());
        }

        $this->redirect('index.php');
    }

    private function handleCreateProcess(array $formData, BookDTO $book)
    {
        $this->dataBinder->bind($formData, $book);
        $this->bookService->create($book);
    }

    private function handleEditProcess(array $formData, BookDTO $book)
    {
        $this->dataBinder->bind($formData, $book);
        $this->bookService->edit($book);
    }

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

    private function checkRights()
    {
        if (!$this->appData->isAdmin()) {
            $this->redirect('index.php');
        }
    }
}