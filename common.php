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

//User Controller Dependencies
$userRepo = new \App\Repository\UserRepository($db);
$encryptionService = new App\Service\Encryption\ArgonEncryptionService();
$userService = new \App\Service\User\UserService($userRepo, $encryptionService);

$userController = new \App\Http\UserController($userService, $template, $dataBinder);

//Home Controller Dependencies
$homeController = new \App\Http\HomeController($template);


//////////////////////////////////////////////////////////////////////////
////////////// TESTING ORM ///////////////////////////////////////////////
/// //////////////////////////////////////////////////////////////////////

$builder = new \Database\ORM\MySQLQueryBuilder($db);

$builder->delete('users',
    [
        'email' => 'plam@abv.bg',
    ]);


echo '------------------------------------------------------';

////////////////////////////////////////////////////////////////////////////




