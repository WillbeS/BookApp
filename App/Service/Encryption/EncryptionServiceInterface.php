<?php


namespace App\Service\Encryption;


interface EncryptionServiceInterface
{
    /**
     * @param string $password
     * @return string
     */
    public function encrypt(string $password): string;

    /**
     * @param string $passwordHash
     * @param string $passwordString
     * @return bool
     */
    public function isValid(string $passwordHash, string $passwordString): bool;
}