<?php


namespace App\Http;


use App\Service\User\UserServiceInterface;
use Core\TemplateInterface;

class UserController extends MainController
{
    /**
     * @var UserServiceInterface
     */
    private $userService;


    /**
     * UserController constructor.
     * @param UserServiceInterface $userService
     * @param TemplateInterface $template
     */
    public function __construct(UserServiceInterface $userService, TemplateInterface $template)
    {
        parent::__construct($template);
        $this->userService = $userService;
    }


    public function register(array $formData)
    {
        if (isset($formData['register'])) {
            $this->handleRegisterProcess($formData);
        } else {
            $this->render('user/register');
        }
    }

    private function handleRegisterProcess(array $formData)
    {
        //TODO
    }
}