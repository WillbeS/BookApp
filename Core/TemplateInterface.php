<?php

namespace Core;

interface TemplateInterface
{
    public function render(string $templateName, $data): void;

    public function renderWithLayout(string $templateName, $contentData = null, $appData = null): void;
}