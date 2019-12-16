<?php


namespace Core;

/**
 * Interface SessionInterface
 * @package Core
 */
interface SessionInterface
{
    /**
     * @param int $id
     * @return SessionInterface
     */
    public function setUserId(int $id): SessionInterface;

    /**
     * @param array $roles
     * @return SessionInterface
     */
    public function setUserRoles(array $roles): SessionInterface;

    /**
     * @return array
     */
    public function getUserRoles(): array;

    /**
     * @return int|null
     */
    public function getUserId(): ?int;

    /**
     * @return array
     */
    public function getMessages(): array;

    /**
     * @param string $message
     * @return SessionInterface
     */
    public function addMessage(string $message): SessionInterface;

    /**
     * @return array
     */
    public function getErrors(): array;

    /**
     * @param string $error
     * @return SessionInterface
     */
    public function addError(string $error): SessionInterface;
}