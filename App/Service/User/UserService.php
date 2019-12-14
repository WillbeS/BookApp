<?php


namespace App\Service\User;


use App\Data\RoleDTO;
use App\Data\UserDTO;
use App\Repository\Role\UsersRolesRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use App\Service\Encryption\EncryptionServiceInterface;

class UserService implements UserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var UsersRolesRepositoryInterface
     */
    private $roleRepository;

    /**
     * @var EncryptionServiceInterface
     */
    private $encryptionService;

    public function __construct(UserRepositoryInterface $userRepository,
                                UsersRolesRepositoryInterface $roleRepository,
                                EncryptionServiceInterface $encryptionService)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
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

        $userRole = $this->roleRepository->findOneBy(['name' => 'ROLE_USER']);

        $userDTO
            ->setPassword($this->encryptionService->encrypt($userDTO->getPassword()))
            ->setActive(false)
        ;

        $userId = $this->userRepository->insert($userDTO);
        $this->roleRepository->addRoleToUser($userId, $userRole->getId());

        return true;
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

    public function getRoles(int $userId): array
    {
        /** @var RoleDTO[] $roles */
        $roles = $this->roleRepository->findRolesByUser($userId);
        $roleNames = [];

        foreach ($roles as $role) {
            $roleNames[] = $role->getName();
        }

        return $roleNames;
    }

    public function isAdmin(int $userId): bool
    {
        $userRoles = $this->getRoles($userId);

        return in_array('ROLE_ADMIN', $userRoles);
    }
}