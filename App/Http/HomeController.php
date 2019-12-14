<?php


namespace App\Http;


use App\Service\User\UserServiceInterface;
use Core\SessionInterface;
use Core\TemplateInterface;

class HomeController extends AbstractController
{
    public function __construct(TemplateInterface $template, SessionInterface $session)
    {
        parent::__construct($template, $session);
    }

    public function index(UserServiceInterface $userService)
    {
        $this->renderWithLayout('home/index');

    }


}