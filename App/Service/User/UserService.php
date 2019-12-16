<?php


namespace App\Service\User;


use App\Data\RoleDTO;
use App\Data\UserDTO;
use App\Exception\InvalidCredentialsException;
use App\Exception\UserNotActiveException;
use App\Repository\Role\UsersRolesRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use App\Service\Encryption\EncryptionServiceInterface;
use Core\Exception\AppException;
use Core\SessionInterface;

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

    /**
     * @var SessionInterface
     */
    protected $session;


    public function __construct(UserRepositoryInterface $userRepository,
                                UsersRolesRepositoryInterface $roleRepository,
                                EncryptionServiceInterface $encryptionService,
                                SessionInterface $session)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->encryptionService = $encryptionService;
        $this->session = $session;
    }


    /**
     * @param UserDTO $userDTO
     * @param string $confirmPassword
     * @return void
     * @throws AppException
     */
    public function register(UserDTO $userDTO, string $confirmPassword): void
    {
        if ($userDTO->getPassword() !== $confirmPassword) {
            throw new AppException('Passwords mismatch.');
        }

        if (null !== $this->userRepository->findByEmail($userDTO->getEmail())) {
            throw new AppException('Email address is already taken.');
        }

        $userRole = $this->roleRepository->findOneBy(['name' => 'ROLE_USER']);

        $userDTO
            ->setHashedPassword($this->encryptionService->encrypt($userDTO->getPassword()))
            ->setActive(false)
        ;

        $userId = $this->userRepository->insert($userDTO);
        $this->roleRepository->addRoleToUser($userId, $userRole->getId());
    }

    /**
     * @param string $email
     * @param string $password
     * @return UserDTO
     * @throws InvalidCredentialsException
     * @throws UserNotActiveException
     */
    public function login(string $email, string $password): UserDTO
    {
        $userDto = $this->userRepository->findByEmail($email);

        if (null === $userDto || !$this->encryptionService->isValid($password, $userDto->getPassword())) {
           throw new InvalidCredentialsException('Invalid username or password');
        }

        if (!$userDto->isActive()) {
            throw new UserNotActiveException('Your registration is not active yet. Please try again later.');
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
     * @param string $oldPassword
     * @param string $newPassword
     * @param string $confirmNewPassword
     * @param UserDTO $currentUser
     * @return mixed|void
     * @throws AppException
     */
    public function changePassword(string $oldPassword,
                                   string $newPassword,
                                   string $confirmNewPassword,
                                   UserDTO $currentUser)
    {
        if (!$this->encryptionService->isValid($oldPassword, $currentUser->getPassword())) {
            throw new AppException('Old password is not correct.');
        }

        if ($newPassword !== $confirmNewPassword) {
            throw new AppException('Passwords mismatch.');
        }

        $currentUser->setHashedPassword($this->encryptionService->encrypt($newPassword));
        return $this->userRepository->updateProfile($currentUser->getId(), $currentUser);
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
        return null !== $this->session->getUserId();
    }

    /**
     * @inheritDoc
     */
    public function getAll(): \Generator
    {
        return $this->userRepository->findAll();
    }

    public function getRoles(): array
    {
        $currentUserId = $this->session->getUserId();

        /** @var RoleDTO[] $roles */
        $roles = $this->roleRepository->findRolesByUser($currentUserId);
        $roleNames = [];

        foreach ($roles as $role) {
            $roleNames[] = $role->getName();
        }

        return $roleNames;
    }
}