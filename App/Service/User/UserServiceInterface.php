<?php


namespace App\Service\User;

use App\Data\UserDTO;

/**
 * Interface UserServiceInterface
 * @package App\Service\User
 */
interface UserServiceInterface
{
    /**
     * @param UserDTO $userDTO
     * @param string $confirmPassword
     * @return void
     */
    public function register(UserDTO $userDTO, string $confirmPassword): void;

    /**
     * @param string $email
     * @param string $password
     * @return UserDTO|null
     */
    public function login(string $email, string $password): UserDTO;

    /**
     * @param UserDTO $userDTO
     * @return bool
     */
    public function edit(UserDTO $userDTO): bool;

    /**
     * @param string $oldPassword
     * @param string $newPassword
     * @param string $confirmNewPassword
     * @param UserDTO $currentUser
     * @return mixed
     */
    public function changePassword(string $oldPassword,
                                   string $newPassword,
                                   string $confirmNewPassword,
                                   UserDTO $currentUser);

    /**
     * @return UserDTO|null
     */
    public function getCurrentUser(): ?UserDTO;

    /**
     * @return bool
     */
    public function isLoggedIn(): bool;

    /**
     * @return \Generator|UserDTO[]
     */
    public function getAll(): \Generator;

    /**
     * @return array
     */
    public function getRoles(): array;
}