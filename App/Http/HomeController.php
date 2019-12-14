<?php


namespace App\Http;


use App\Service\User\UserServiceInterface;
use Core\TemplateInterface;

class HomeController extends AbstractController
{
    public function __construct(TemplateInterface $template)
    {
        parent::__construct($template);
    }

    public function index(UserServiceInterface $userService)
    {
        $this->renderWithLayout('home/index');

    }


}