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
        // TODO: Implement login() method.
    }

    /**
     * @inheritDoc
     */
    public function edit(UserDTO $userDTO): bool
    {
        // TODO: Implement edit() method.
    }

    /**
     * @inheritDoc
     */
    public function getCurrentUser(): ?UserDTO
    {
        // TODO: Implement getCurrentUser() method.
    }

    /**
     * @inheritDoc
     */
    public function isLoggedIn(): bool
    {
        // TODO: Implement isLoggedIn() method.
    }

    /**
     * @inheritDoc
     */
    public function getAll(): \Generator
    {
        // TODO: Implement getAll() method.
    }
}