<?php

declare(strict_types=1);

use Domain\Authentication\Aggregate\User;
use Domain\Authentication\Value\Email;
use Domain\Authentication\Value\Password;
use Infrastructure\DefaultContainer;

require_once __DIR__ . '/../vendor/autoload.php';

$container = new DefaultContainer();

$email = Email::fromString($_POST['emailAddress']);
$password = new Password($_POST['password']);

try {
    $user = User::register(
        $container->isUserRegistered(),
        $container->hashPassword(),
        $email,
        $password
    );
} catch (\Exception $exception) {
    echo 'Already registered';

    return;
}

$container->users()->store($user);

echo \sprintf(
    'Successfully registered as "%s"!',
    $user->email()->value()
);
