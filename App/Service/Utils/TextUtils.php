<?php

namespace AppBundle\Service\Utils;

class TextUtils implements TextUtilsInterface
{
    /**
     * @var LatinConverterInterface
     */
    private $latinConverter;

    /**
     * TextUtils constructor.
     * @param LatinConverterInterface $latinConverter
     */
    public function __construct(LatinConverterInterface $latinConverter)
    {
        $this->latinConverter = $latinConverter;
    }


    // Works with both latin and cyrillic, returns latin
    public function getSlug(string $text,
                            bool $removeShortWords = true,
                            int $length = 2): string
    {
        $text = $this->cleanSpecialChars($text, ' ');

        if (!mb_detect_encoding($text, 'ASCII', true)) {
            $text = $this->latinConverter->convert($text);
        }

        // Clean all dashes and space and replace with 1 space only
        $text = preg_replace(
            '/\s+\-\s+/',
            ' ',
            mb_strtolower($this->trimAllWhiteSpace(strip_tags($text)))
        );

        if ($removeShortWords) {
            $text = $this->removeShortWords($text);
        }

        // Replace space with a dash
        return preg_replace('/\s+/', '-', $text);
    }


    // Works for all character sets
    public function trimAllWhiteSpace(string $text): string
    {
        return trim($text, "\x20,\xC2,\xA0");
    }

    // Works both with latin and cyrillic
    public function cleanSpecialChars(string $text, string $replacement = ''): string
    {
        //$latinPattern = '/[^A-Za-z0-9\s]/';
        $pattern = '~(*UTF8)[^\p{L}0-9\s]~';

        return preg_replace($pattern, $replacement, $text);
    }


    public function removeShortWords(string $text,
                                     int $count = 2,
                                     bool $beginAtStart = false): string
    {
        $pattern = '/\W+\b\w{1,'.$count.'}\b/';

        if ($beginAtStart) {
            $pattern = '/\W*\b\w{1,'.$count.'}\b/';
        }

        while (preg_match($pattern, $text)) {
            $text = preg_replace($pattern, '', $text);
        }

        if ($beginAtStart) {
            return $this->trimAllWhiteSpace($text);
        }

        return $text;
    }


    public function shortenText(string $text, int $maxLength = 30): string
    {
        if(mb_strpos(trim($text), ' ') == false)
        {
            return $text;
        }

        if (mb_strlen($text) <= $maxLength) {
            return $text;
        }

        $text = mb_substr($text, 0, mb_strrpos(mb_substr($text, 0, $maxLength + 1), ' ')) . '...';

        return $text;
    }

    public function getRandomString(int $length = null): string
    {
        $str =  md5(uniqid());

        if (null !== $length) {
            $str = substr($str, 0, $length);
        }
        return  $str;
    }

}