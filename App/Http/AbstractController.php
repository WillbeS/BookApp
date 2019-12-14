<?php


namespace App\Http;


use Core\SessionInterface;
use Core\TemplateInterface;

abstract class AbstractController
{
    /**
     * @var TemplateInterface
     */
    private $template;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * MainController constructor.
     * @param TemplateInterface $template
     * @param SessionInterface $session
     */
    public function __construct(TemplateInterface $template, SessionInterface $session)
    {
        $this->template = $template;
        $this->session = $session;
    }

    protected function render(string $templateName, $data = null)
    {
        $this->template->render($templateName, $data);
    }

    protected function redirect(string $url)
    {
        header("Location: $url");
    }

    protected function renderWithLayout(string $templateName, $contentData = null, $appData = null): void
    {
        $appData = null !== $appData ? $appData : $this->getSession();

        $this->template->renderWithLayout($templateName, $contentData, $appData);
    }

    protected function getSession(): SessionInterface
    {
        return $this->session;
    }

    protected function addFlashMessage(string $message): void
    {
        $this->session->addMessage($message);
    }

    protected function addFlashError(string $error): void
    {
        $this->session->addError($error);
    }
}