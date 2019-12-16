<?php

namespace Core;

/**
 * Interface TemplateInterface
 * @package Core
 */
interface TemplateInterface
{
    /**
     * @param string $templateName
     * @param $data
     */
    public function render(string $templateName, $data): void;

    /**
     * @param string $templateName
     * @param null $contentData
     * @param null $appData
     */
    public function renderWithLayout(string $templateName, $contentData = null, $appData = null): void;
}