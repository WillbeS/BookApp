<?php


namespace App\Http;


use App\Data\UserDTO;
use App\Service\User\UserServiceInterface;
use Core\DataBinderInterface;
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
     */
    public function __construct(UserServiceInterface $userService,
                                TemplateInterface $template,
                                DataBinderInterface $dataBinder)
    {
        parent::__construct($template);
        $this->userService = $userService;
        $this->dataBinder = $dataBinder;
    }


    public function register(array $formData)
    {
        $user = UserDTO::create();

        if (isset($formData['register'])) {
            if ($this->handleRegisterProcess($formData, $user)) {
                $this->redirect('login.php');
            } else {
                //TODO - flash message
                $this->render('user/register', $user);
            }
        } else {
            $this->render('user/register', $user);
        }
    }

    public function login(array $formData)
    {
        if (isset($formData['login'])) {
            $userDto = $this->handleLoginProcess($formData);
            if (null !== $userDto) {
                $_SESSION['userId'] = $userDto->getId();
                $this->redirect('index.php');
            } else {
                //TODO - some error/messages handling
            }
        } else {
            $this->render('user/login');
        }
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
                //TODO - some error/messages handling
            }
        } else {
            $this->render('user/edit_profile', $user);
        }
    }

    private function handleRegisterProcess(array $formData, UserDTO $user): bool
    {
        $this->dataBinder->bind($formData, $user);

        return $this->userService->register($user, $formData['confirm_password']);
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