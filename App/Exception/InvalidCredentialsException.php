<?php


namespace App\Exception;


use Throwable;

class InvalidCredentialsException extends AppException
{
    const MESSAGE = 'Invalid credentials.';

    public function __construct($message = "")
    {
        $message = $message ? $message : self::MESSAGE;

        parent::__construct($message);
    }
}