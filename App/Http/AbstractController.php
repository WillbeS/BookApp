<?php


namespace App\Http;


use Core\TemplateInterface;

abstract class AbstractController
{
    /**
     * @var TemplateInterface
     */
    private $template;

    /**
     * MainController constructor.
     * @param TemplateInterface $template
     */
    public function __construct(TemplateInterface $template)
    {
        $this->template = $template;
    }

    public function render(string $templateName, $data = null)
    {
        $this->template->render($templateName, $data);
    }

    protected function redirect(string $url)
    {
        header("Location: $url");
    }

    protected function renderWithLayout(string $templateName, $data = null): void
    {
        $this->template->renderWithLayout($templateName, $data);
    }

}