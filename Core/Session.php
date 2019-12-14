<?php


namespace Core;


class Session implements SessionInterface
{

    public function __construct()
    {
        if (!isset($_SESSION['messages'])) {
            $_SESSION['messages'] = [];
        }

        if (!isset($_SESSION['messages'])) {
            $_SESSION['errors'] = [];
        }
    }

    /**
     * @param int $id
     * @return SessionInterface
     */
    public function setUserId(int $id): SessionInterface
    {
        $_SESSION['userId'] = $id;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        if (isset($_SESSION['userId'])) {
            return $_SESSION['userId'];
        }

        return null;
    }

    public function getMessages(): array
    {
        $messages = $_SESSION['messages'];
        $_SESSION['messages'] = [];

        return $messages;
    }

    public function getErrors(): array
    {
        $errors = $_SESSION['errors'];
        $_SESSION['errors'] = [];

        return $errors;
    }

    public function addMessage(string $message): SessionInterface
    {
        $_SESSION['messages'][] = $message;

        return $this;
    }

    public function addError(string $error): SessionInterface
    {
        $_SESSION['errors'][] = $error;

        return $this;
    }
}