<?php


namespace Core;


class Session implements SessionInterface
{

    /**
     * @param int $id
     * @return SessionInterface
     */
    public function setUserId(int $id = null): SessionInterface
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
        if (!isset($_SESSION['messages'])) {
            $_SESSION['messages'] = [];
        }

        $messages = $_SESSION['messages'];
        $_SESSION['messages'] = [];

        return $messages;
    }

    public function getErrors(): array
    {
        if (!isset($_SESSION['messages'])) {
            $_SESSION['errors'] = [];
        }

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

    public function setUserRoles(array $roles): SessionInterface
    {
        $_SESSION['userRoles'] = $roles;

        return $this;
    }

    public function getUserRoles(): array
    {
        if (!isset($_SESSION['userRoles'])) {
            $_SESSION['userRoles'] = [];
        }

        return $_SESSION['userRoles'];
    }
}