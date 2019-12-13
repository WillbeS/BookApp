<?php


namespace App\Service\User;


use App\Data\UserDTO;
use App\Repository\UserRepositoryInterface;
use App\Service\Encryption\EncryptionServiceInterface;

class UserService implements UserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var EncryptionServiceInterface
     */
    private $encryptionService;

    public function __construct(UserRepositoryInterface $userRepository,
                                EncryptionServiceInterface $encryptionService)
    {
        $this->userRepository = $userRepository;
        $this->encryptionService = $encryptionService;
    }


    /**
     * @inheritDoc
     */
    public function register(UserDTO $userDTO, string $confirmPassword): bool
    {
        if ($userDTO->getPassword() !== $confirmPassword) {
            return false;
        }

        if (null !== $this->userRepository->findByEmail($userDTO->getEmail())) {
            return false;
        }

        $userDTO
            ->setPassword($this->encryptionService->encrypt($userDTO->getPassword()))
            ->setActive(false)
        ;

        return $this->userRepository->insert($userDTO);
    }

    /**
     * @inheritDoc
     */
    public function login(string $email, string $password): ?UserDTO
    {
        $userDto = $this->userRepository->findByEmail($email);

        if (null === $userDto || !$this->encryptionService->isValid($password, $userDto->getPassword())) {
            return null;
        }

        return $userDto;
    }

    /**
     * @inheritDoc
     */
    public function edit(UserDTO $userDTO): bool
    {
        return $this->userRepository->updateProfile($userDTO->getId(), $userDTO);
    }

    /**
     * @inheritDoc
     */
    public function getCurrentUser(): ?UserDTO
    {
        if (!isset($_SESSION['userId'])) {
            return null;
        }

        return $this->userRepository->findById($_SESSION['userId']);
    }

    /**
     * @inheritDoc
     */
    public function isLoggedIn(): bool
    {
        return isset($_SESSION['userId']);
    }

    /**
     * @inheritDoc
     */
    public function getAll(): \Generator
    {
        return $this->userRepository->findAll();
    }
}