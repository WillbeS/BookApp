<?php


namespace App\Traits;

use Core\Exception\FormValidationException;


//TODO - decide if better use abstract DTO class instead
trait FormValidationTrait
{
    /**
     * @param string $input
     * @param string $fieldName
     * @param int $min
     * @param int $max
     * @throws FormValidationException
     */
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

    /**
     * @param string $input
     * @param string $fieldName
     * @param int $min
     * @throws FormValidationException
     */
    public function validateMinLength(string $input, string $fieldName, int $min = 3)
    {
        if ($min > strlen($input)) {
            throw new FormValidationException($fieldName . ' must be at least '
                . $min
                . ' characters long.');
        }
    }

    /**
     * @param string $input
     * @param string $fieldName
     * @param int $max
     * @throws FormValidationException
     */
    public function validateMaxLength(string $input, string $fieldName, int $max = 100)
    {
        if (strlen($input) > $max) {
            throw new FormValidationException($fieldName . ' cannot be more than '
                . $max
                . ' characters long.');
        }
    }

    /**
     * @param string $input
     * @param string $fieldName
     * @throws FormValidationException
     */
    public function validateLatinCharactersAndDigits(string $input, string $fieldName)
    {
        $pattern = '/^[a-zA-Z\d]*$/';

        if (!preg_match($pattern, $input)) {
            throw new FormValidationException($fieldName . ' must contain only latin characters and digits');
        }
    }

    /**
     * @param string $input
     * @param string $fieldName
     * @param string $pattern
     * @param string|null $message
     * @throws FormValidationException
     */
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