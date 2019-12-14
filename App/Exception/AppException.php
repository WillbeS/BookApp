<?php


namespace App\Exception;


use Throwable;

class AppException extends \Exception
{
    const MESSAGE = 'Something went wrong.';

    public function __construct($message = "")
    {
        if (empty($message)) {
            $message = self::MESSAGE;
        }
        parent::__construct($message, 0, null);
    }
}