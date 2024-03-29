<?php


namespace App\Http;


use App\Data\UserDTO;
use App\Exception\InvalidCredentialsException;
use App\Exception\UserNotActiveException;
use App\Service\User\UserServiceInterface;
use Core\DataBinderInterface;
use Core\Exception\AppException;
use Core\SessionInterface;
use Core\TemplateInterface;

class UserController extends AbstractController
{
    /**
     * @var UserServiceInterface
     */
    private $userService;

    /**
     * @var DataBinderInterface
     */
    private $dataBinder;


    /**
     * UserController constructor.
     * @param UserServiceInterface $userService
     * @param TemplateInterface $template
     * @param DataBinderInterface $dataBinder
     * @param SessionInterface $session
     */
    public function __construct(UserServiceInterface $userService,
                                TemplateInterface $template,
                                DataBinderInterface $dataBinder,
                                SessionInterface $session)
    {
        parent::__construct($template, $session);
        $this->userService = $userService;
        $this->dataBinder = $dataBinder;
    }


    /**
     * @param array $formData
     */
    public function register(array $formData)
    {
        $user = UserDTO::create();

        if (isset($formData['register'])) {
            try {
                $this->handleRegisterProcess($formData, $user);
                $this->addFlashMessage('Congratulations! Your registration was successful. You will be able to login into your account once it has been activated by our administration.');
                $this->redirect('index.php');
            } catch (AppException $exception) {
                $this->addFlashError($exception->getMessage());
                $this->renderWithLayout('user/register', $user);
            }
        } else {
            $this->renderWithLayout('user/register', $user);
        }
    }

    /**
     * @param array $formData
     */
    public function login(array $formData)
    {
        if (isset($formData['login'])) {
            try {
                $this->handleLoginProcess($formData);
                $this->redirect('index.php');
            } catch (UserNotActiveException $exception) {
                $this->addFlashError($exception->getMessage());
                $this->redirect('index.php');
            } catch (InvalidCredentialsException $exception) {
                $this->addFlashError($exception->getMessage());
                $this->renderWithLayout('user/login');
            }
        } else {
            $this->renderWithLayout('user/login');
        }
    }

    public function logout()
    {
        $this->session->setUserId(null);
        $this->session->setUserRoles([]);
        $this->redirect('index.php');
    }

    /**
     * @param array $formData
     */
    public function profile(array $formData)
    {
        if (!$this->userService->isLoggedIn()) {
            $this->redirect('login.php');
        }

        $user = $this->userService->getCurrentUser();

        try {
            if (isset($formData['edit'])) {
                $this->handleEditProfileProcess($formData, $user);
                $this->addFlashMessage('Your changes were saved.');
                $this->redirect('profile.php');
            } elseif (isset($formData['change_password'])) {
                $this->handleChangePasswordProcess($formData, $user);
                $this->addFlashMessage('Your changes were saved.');
                $this->redirect('profile.php');
            } else {
                $this->renderWithLayout('user/profile', $user);
            }
        } catch (AppException $exception) {
            $this->addFlashError($exception->getMessage());
            $this->renderWithLayout('user/profile', $user);
        }
    }

    // Private methods

    /**
     * @param array $formData
     * @param UserDTO $user
     */
    private function handleRegisterProcess(array $formData, UserDTO $user)
    {
        $this->dataBinder->bindFormDataWithValidation($formData, $user);
        $this->userService->register($user, $formData['confirm_password']);
    }

    /**
     * @param array $formData
     */
    private function handleLoginProcess(array $formData)
    {
        $userDto = $this->userService->login($formData['email'], $formData['password']);
        $this->session->setUserId($userDto->getId());
        $this->session->setUserRoles($this->userService->getRoles());
    }

    /**
     * @param array $formData
     * @param UserDTO $userDTO
     * @return bool
     */
    private function handleEditProfileProcess(array $formData, UserDTO $userDTO): bool
    {
        $this->dataBinder->bindFormDataWithValidation($formData, $userDTO);
        return $this->userService->edit($userDTO);
    }

    /**
     * @param array $formData
     * @param UserDTO $currentUser
     */
    private function handleChangePasswordProcess(array $formData, UserDTO $currentUser)
    {
        $this->userService->changePassword(
            $formData['old_password'],
            $formData['new_password'],
            $formData['confirm_new_password'],
            $currentUser
        );
    }
}