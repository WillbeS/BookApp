<?php


namespace App\Service\User;


use App\Data\UserDTO;

interface UserServiceInterface
{
    /**
     * @param UserDTO $userDTO
     * @param string $confirmPassword
     * @return bool
     */
    public function register(UserDTO $userDTO, string $confirmPassword): bool;

    /**
     * @param string $email
     * @param string $password
     * @return UserDTO|null
     */
    public function login(string $email, string $password): ?UserDTO;

    /**
     * @param UserDTO $userDTO
     * @return bool
     */
    public function edit(UserDTO $userDTO): bool;

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
}