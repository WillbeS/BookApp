<?php

namespace App\Data;


use App\Traits\FormValidationTrait;
use Core\Exception\FormValidationException;

class UserDTO
{
    use FormValidationTrait;

    const NAME_MIN_LENGTH = 3;

    const NAME_MAX_LENGTH = 50;

    const MIN_PASSWORD_LENGTH = 6;

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


    public static function create(): UserDTO
    {
        return new UserDTO();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return UserDTO
     * @throws FormValidationException
     * @throws FormValidationException
     */
    public function setFirstName(string $firstName): UserDTO
    {
        $this->validateLength($firstName, 'First name', self::NAME_MIN_LENGTH, self::NAME_MAX_LENGTH);
        $this->validateLatinCharactersAndDigits($firstName,'First name');

        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return UserDTO
     * @throws FormValidationException
     */
    public function setLastName(string $lastName): UserDTO
    {
        $this->validateLength($lastName, 'Last name', self::NAME_MIN_LENGTH, self::NAME_MAX_LENGTH);
        $this->validateLatinCharactersAndDigits($lastName,'Last name');

        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return UserDTO
     * @throws FormValidationException
     */
    public function setEmail(string $email): UserDTO
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new FormValidationException('Invalid email format');
        }

        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return UserDTO
     * @throws FormValidationException
     * @throws FormValidationException
     */
    public function setPassword(string $password): UserDTO
    {
        $this->validateLength($password, 'Password', self::MIN_PASSWORD_LENGTH);
        $this->validateLatinCharactersAndDigits($password,'Password');

        $this->password = $password;

        return $this;
    }

    /**
     * @param string $hashedPassword
     * @return UserDTO
     */
    public function setHashedPassword(string $hashedPassword): UserDTO
    {
        $this->password = $hashedPassword;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function isActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param bool|null $active
     * @return UserDTO
     */
    public function setActive(bool $active = null): UserDTO
    {
        $this->active = $active;

        return $this;
    }
}