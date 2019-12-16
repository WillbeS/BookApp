<?php


namespace App\Http;

use App\Data\Template\AppData;
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
    protected $session;

    /**
     * @var AppData
     */
    protected $appData;

    /**
     * MainController constructor.
     * @param TemplateInterface $template
     * @param SessionInterface $session
     */
    public function __construct(TemplateInterface $template, SessionInterface $session)
    {
        $this->template = $template;
        $this->session = $session;

        $this->initAppData();
    }

    /**
     * @param string $templateName
     * @param null $data
     */
    protected function render(string $templateName, $data = null)
    {
        $this->template->render($templateName, $data);
    }

    /**
     * @param string $url
     */
    protected function redirect(string $url)
    {
        header("Location: $url");
    }

    /**
     * @param string $templateName
     * @param null $contentData
     * @param null $appData
     */
    protected function renderWithLayout(string $templateName, $contentData = null, $appData = null): void
    {
        $appData = null !== $appData ? $appData : $this->appData;

        $this->template->renderWithLayout($templateName, $contentData, $appData);
    }

//    protected function getSession(): SessionInterface
//    {
//        return $this->session;
//    }

    /**
     * @param string $message
     */
    protected function addFlashMessage(string $message): void
    {
        $this->session->addMessage($message);
    }

    /**
     * @param string $error
     */
    protected function addFlashError(string $error): void
    {
        $this->session->addError($error);
    }

    protected function initAppData()
    {
        $this->appData = (new AppData())
            ->setSession($this->session)
        ;
    }
}