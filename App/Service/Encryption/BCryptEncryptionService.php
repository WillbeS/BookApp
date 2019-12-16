<?php

namespace App\Service\Encryption;

/**
 * Class BCryptEncryptionService
 * @package App\Service\Encryption
 */
class BCryptEncryptionService implements EncryptionServiceInterface
{
    /**
     * @param string $password
     * @return string
     */
    public function encrypt(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * @param string $passwordHash
     * @param string $passwordString
     * @return bool
     */
    public function isValid( string $passwordString, string $passwordHash): bool
    {
        return password_verify($passwordString, $passwordHash);
    }
}