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

//User Controller Dependencies
$userRepo = new \App\Repository\UserRepository($queryBuilder);
$encryptionService = new App\Service\Encryption\ArgonEncryptionService();
$userService = new \App\Service\User\UserService($userRepo, $encryptionService);

$userController = new \App\Http\UserController($userService, $template, $dataBinder);

//Home Controller Dependencies
$homeController = new \App\Http\HomeController($template);


//////////////////////////////////////////////////////////////////////////
////////////// TESTING ORM ///////////////////////////////////////////////
/// //////////////////////////////////////////////////////////////////////


//
//$newUSerRepository = new \App\Repository\UserRepository($builder);
//
//$user = \App\Data\UserDTO::create();
//
//$user->setFirstName('plam2Edited')
//    ->setLastName('hhh')
//    ->setEmail('email4')
//    ->setPassword('pass')
//    ->setActive(true);
//
////$newUSerRepository->insert($user);
//var_dump($newUSerRepository->findByEmail('email4'));
//
//echo '------------------------------------------------------';

////////////////////////////////////////////////////////////////////////////




