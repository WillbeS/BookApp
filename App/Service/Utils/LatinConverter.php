<?php


namespace AppBundle\Service\Utils;


class LatinConverter implements LatinConverterInterface
{
    const BG_ALPHABET = [
        // upper case
        'А' => 'A',     'Б' => 'B',     'В' => 'V',     'Г' => 'G',
        'Д' => 'D',     'Е' => 'E',     'З' => 'Z',     'И' => 'I',
        'К' => 'K',     'Л' => 'L',     'М' => 'M',     'Н' => 'N',
        'О' => 'O',     'П' => 'P',     'Р' => 'R',     'С' => 'S',
        'Т' => 'T',     'Ф' => 'F',     'Ж' => 'ZH',    'Ч' => 'CH',
        'Ш' => 'SH',    'Щ' => 'SHT',   'Х' => 'H',     'Ц' => 'TS',
        'Ь' => 'Y',     'Й' => 'Y',     'Ю' => 'YU',    'Я' => 'YA',
        'У' => 'U',     'Ъ' => 'A',     'ѣ' => 'YA',    'Ѫ' => 'Ŭ',
        // lower case
        'а' => 'a',     'б' => 'b',     'в' => 'v',     'г' => 'g',
        'д' => 'd',     'е' => 'e',     'з' => 'z',     'и' => 'i',
        'к' => 'k',     'л' => 'l',     'м' => 'm',     'н' => 'n',
        'о' => 'o',     'п' => 'p',     'р' => 'r',     'с' => 's',
        'т' => 't',     'ф' => 'f',     'ж' => 'zh',    'ч' => 'ch',
        'ш' => 'sh',    'щ' => 'sht',   'х' => 'h',     'ц' => 'ts',
        'ь' => 'y',     'й' => 'y',     'ю' => 'yu',    'я' => 'ya',
        'у' => 'u',     'ъ' => 'a',     'ѣ' => 'ya',    'ѫ' => 'ŭ',
    ];


    public function convert(string $text):string
    {
        $language = [
            'from' => array_keys(self::BG_ALPHABET),
            'to' => array_values(self::BG_ALPHABET),
        ];

        $text = str_replace($language['from'], $language['to'], $text);

        return $text;
    }
}