<?php


namespace App\Exception;


use Core\Exception\AppException;
use Throwable;

class UserNotActiveException extends AppException
{
    const MESSAGE = 'Account is not active.';

    public function __construct($message = "")
    {
        $message = $message ? $message : self::MESSAGE;

        parent::__construct($message);
    }
}