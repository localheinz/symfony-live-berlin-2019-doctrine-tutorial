<?php

declare(strict_types=1);

use Domain\Authentication\Entity\User;
use Infrastructure\StaticContainer;

require_once __DIR__ . '/../vendor/autoload.php';

$email = $_POST['emailAddress'];
$password = $_POST['password'];

$container = new StaticContainer();

$hashPassword = $container->hashPassword();

$isUserRegistered = $container->isUserRegistered();

if ($isUserRegistered($email)) {
    echo 'Already registered';

    return;
}

$user = new User(
    $email,
    $hashPassword($password)
);

$users = $container->users();

$users->store($user);

echo \sprintf(
    'Successfully registered as "%s"!',
    $email
);
