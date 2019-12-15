<?php


namespace AppBundle\Service\Utils;


interface LatinConverterInterface
{
    public function convert(string $text):string;
}