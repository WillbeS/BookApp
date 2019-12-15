<?php


namespace App\Traits;


use App\Exception\FormValidationException;
use Cassandra\Exception\ValidationException;

//TODO - decide if better use abstract DTO class instead
trait FormValidationTrait
{
    public function validateLength(string $input, string $fieldName, int $min = 3, int $max = 100)
    {
        if ($min > strlen($input) || strlen($input) > $max) {
            throw new FormValidationException($fieldName . ' must be between '
                . $min
                . ' and '
                . $max
                . ' characters long.');
        }
    }

    public function validateLatinCharactersAndDigits(string $input, string $fieldName)
    {
        $pattern = '/^[a-zA-Z\d]*$/';

        if (!preg_match($pattern, $input)) {
            throw new FormValidationException($fieldName . ' must contain only latin characters and digits');
        }
    }

    public function validateWithRegex(string $input, string $fieldName, string $pattern, string $message = null)
    {
        if (null === $message) {
            $message = $fieldName . ' contains invalid characters.';
        }

        if (!preg_match($pattern, $input)) {
            throw new FormValidationException($fieldName . $message);
        }
    }
}