<?php


namespace App\Exception;


use Throwable;

class FormValidationException extends AppException
{
    const MESSAGE = 'Invalid form data.';

    public function __construct($message = "")
    {
        $message = $message ? $message : self::MESSAGE;

        parent::__construct($message);
    }
}