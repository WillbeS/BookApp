<?php


namespace Core;


class Template implements TemplateInterface
{
    const TEMPLATE_FOLDER = 'App/Template';

    const BASE_LAYOUT = 'layout/base';

    const TEMPLATE_EXTENSION = '.php';

    public function render(string $templateName, $data = null): void
    {
        require_once $this->getFullTemplateName($templateName);
    }

    public function renderWithLayout(string $templateName, $data = null): void
    {
        $templateName = $this->getFullTemplateName($templateName);

        require_once
            self::TEMPLATE_FOLDER
            . DIRECTORY_SEPARATOR
            . self::BASE_LAYOUT
            . self::TEMPLATE_EXTENSION;
    }



    private function getFullTemplateName(string $templateName): string
    {
        return  self::TEMPLATE_FOLDER
            . DIRECTORY_SEPARATOR
            . $templateName
            . self::TEMPLATE_EXTENSION;
    }
}