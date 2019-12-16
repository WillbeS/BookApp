<?php

session_start();

spl_autoload_register(function($className) {
    $classPath =
        join(DIRECTORY_SEPARATOR, explode('\\', $className)) .
        '.php';

    if (!is_readable($classPath)) {
        throw new \Exception('Error in your path: ' . $classPath);
    }

    require_once $classPath;
});

$db = new \Database\PDODatabase(\Config\DbConfig::DB_HOST,
                                \Config\DbConfig::DB_NAME,
                                \Config\DbConfig::DB_USER,
                                \Config\DbConfig::DB_PASS);

$template = new \Core\Template();
$dataBinder = new \Core\DataBinder();
$queryBuilder = new \Database\ORM\MySQLQueryBuilder($db);
$session = new \Core\Session();

//User Controller Dependencies
$userRepo = new \App\Repository\UserRepository($queryBuilder);
$roleRepo = new \App\Repository\Role\RoleRepository($queryBuilder);

$encryptionService = new App\Service\Encryption\ArgonEncryptionService();
$userService = new \App\Service\User\UserService($userRepo, $roleRepo, $encryptionService, $session);

$userController = new \App\Http\UserController($userService, $template, $dataBinder, $session);

//AdminController
$bookRepository = new \App\Repository\Book\BookRepository($queryBuilder);
$bookService = new \App\Service\Book\BookService($bookRepository);
$adminController = new \App\Http\AdminController($template, $session, $bookService, $dataBinder);

//Home Controller Dependencies
$homeController = new \App\Http\HomeController($template, $session, $bookService);

//BookController
$bookController = new \App\Http\BookController($template, $session, $bookService);





