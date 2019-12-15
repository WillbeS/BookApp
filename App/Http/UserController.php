<?php


namespace App\Http;


use App\Data\UserDTO;
use App\Exception\InvalidCredentialsException;
use App\Exception\UserNotActiveException;
use App\Exception\RegisterException;
use App\Service\User\UserServiceInterface;
use Core\DataBinderInterface;
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


    public function register(array $formData)
    {
        $user = UserDTO::create();

        if (isset($formData['register'])) {
            try {
                $this->handleRegisterProcess($formData, $user);
                $this->addFlashMessage('Congratulations! Your registration was successful. You will be able to login into your account once it has been activated by our administration.');
                $this->redirect('index.php');
            } catch (RegisterException $exception) {
                $this->addFlashError($exception->getMessage());
                $this->renderWithLayout('user/register', $user);
            }
        } else {
            $this->renderWithLayout('user/register', $user);
        }
    }

    public function login(array $formData)
    {
        if (isset($formData['login'])) {
            try {
                $userDto = $this->handleLoginProcess($formData);
                $this->session->setUserId($userDto->getId());
                $this->session->setUserRoles($this->userService->getRoles());
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

    public function editProfile(array $formData)
    {
        if (!$this->userService->isLoggedIn()) {
            $this->redirect('login.php');
        }

        $user = $this->userService->getCurrentUser();

        if (isset($formData['edit'])) {
            if ($this->handleEditProfileProcess($formData, $user)) {
                $this->redirect('index.php');
            } else {
                var_dump('Error'); //temp
                //TODO - some error/messages handling
            }
        } else {
            $this->render('user/edit_profile', $user);
        }
    }



    // Private methods

    private function handleRegisterProcess(array $formData, UserDTO $user)
    {
        $this->dataBinder->bind($formData, $user);

        $this->userService->register($user, $formData['confirm_password']);
    }

    private function handleLoginProcess(array $formData): ?UserDTO
    {
         return $this->userService->login($formData['email'], $formData['password']);
    }

    private function handleEditProfileProcess(array $formData, UserDTO $userDTO): bool
    {
        $this->dataBinder->bind($formData, $userDTO);

        //TODO - check for change password

        return $this->userService->edit($userDTO);
    }
}