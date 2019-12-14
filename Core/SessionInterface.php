<?php


namespace Core;


interface SessionInterface
{
    public function setUserId(int $id): SessionInterface;

    public function getUserId(): ?int;

    public function getMessages(): array;

    public function addMessage(string $message): SessionInterface;

    public function getErrors(): array;

    public function addError(string $error): SessionInterface;
}