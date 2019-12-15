<?php

namespace AppBundle\Service\Utils;


interface TextUtilsInterface
{
    public function trimAllWhiteSpace(string $text): string;

    public function getSlug(string $text): string;

    public function shortenText(string $text, int $maxLength = 30): string;

    public function cleanSpecialChars(string $text, string $replacement = ''): string;

    public function removeShortWords(string $text, int $count = 2, bool $beginAtStart = false): string;

    public function getRandomString(int $length = null): string;
}