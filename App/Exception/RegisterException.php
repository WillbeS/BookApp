<?php


namespace App\Exception;


use Throwable;

class RegisterException extends \Exception
{
    const MESSAGE = 'Registration not successful.';

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        if (empty($message)) {
            $message = self::MESSAGE;
        }
        parent::__construct($message, $code, $previous);
    }
}