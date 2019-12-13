<?php

namespace App\Service\Encryption;


class ArgonEncryptionService implements EncryptionServiceInterface
{
    /**
     * @param string $password
     * @return string
     */
    public function encrypt(string $password): string
    {
        return password_hash($password, PASSWORD_ARGON2I);
    }

    /**
     * @param string $passwordHash
     * @param string $passwordString
     * @return bool
     */
    public function isValid(string $passwordHash, string $passwordString): bool
    {
        return password_verify($passwordString, $passwordHash);
    }
}