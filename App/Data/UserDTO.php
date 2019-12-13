<?php

namespace App\Data;


class UserDTO
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var bool
     */
    private $active;


    public static function create(string $firstName,
                                  string $lastName,
                                  string $email,
                                  string $password,
                                  bool $active,
                                  int $id = null): UserDTO
    {
        return (new UserDTO())
            ->setId($id)
            ->setFirstName($firstName)
            ->setLastName($lastName)
            ->setEmail($email)
            ->setPassword($password)
            ->setActive($active)
            ;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return UserDTO
     */
    public function setId(int $id): UserDTO
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return UserDTO
     */
    public function setFirstName(string $firstName): UserDTO
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return UserDTO
     */
    public function setLastName(string $lastName): UserDTO
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return UserDTO
     */
    public function setEmail(string $email): UserDTO
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return UserDTO
     */
    public function setPassword(string $password): UserDTO
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return UserDTO
     */
    public function setActive(bool $active): UserDTO
    {
        $this->active = $active;

        return $this;
    }
}