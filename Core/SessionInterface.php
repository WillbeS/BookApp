<?php


namespace Core;


interface SessionInterface
{
    public function setUserId(int $id): SessionInterface;

    public function setUserRoles(array $roles): SessionInterface;

    public function getUserRoles(): array;

    public function getUserId(): ?int;

    public function getMessages(): array;

    public function addMessage(string $message): SessionInterface;

    public function getErrors(): array;

    public function addError(string $error): SessionInterface;
}