<?php


namespace Core;

/**
 * Class Template
 * @package Core
 */
class Template implements TemplateInterface
{
    const TEMPLATE_FOLDER = 'App/Template';

    const BASE_LAYOUT = 'layout/base';

    const TEMPLATE_EXTENSION = '.php';

    /**
     * @param string $templateName
     * @param null $data
     */
    public function render(string $templateName, $data = null): void
    {
        require_once $this->getFullTemplateName($templateName);
    }

    /**
     * @param string $templateName
     * @param null $contentData
     * @param null $appData
     */
    public function renderWithLayout(string $templateName, $contentData = null, $appData = null): void
    {
        $templateName = $this->getFullTemplateName($templateName);

        require_once
            self::TEMPLATE_FOLDER
            . DIRECTORY_SEPARATOR
            . self::BASE_LAYOUT
            . self::TEMPLATE_EXTENSION;
    }

    /**
     * @param string $templateName
     * @return string
     */
    private function getFullTemplateName(string $templateName): string
    {
        return  self::TEMPLATE_FOLDER
            . DIRECTORY_SEPARATOR
            . $templateName
            . self::TEMPLATE_EXTENSION;
    }
}