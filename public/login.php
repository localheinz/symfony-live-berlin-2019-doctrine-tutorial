<?php

declare(strict_types=1);

use Domain\Authentication\Value\Email;
use Domain\Authentication\Value\Password;
use Infrastructure\DefaultContainer;

require_once __DIR__ . '/../vendor/autoload.php';

$email = Email::fromString($_POST['emailAddress']);
$password = Password::fromString($_POST['password']);

$container = new DefaultContainer();

try {
    $user = $container->users()->get($email);
} catch (\Exception $exception) {
    echo \sprintf(
        'Failed logging in "%s"!',
        $email->asString()
    );

    return;
}

if (!$user->login($container->verifyPassword(), $password)) {
    echo \sprintf(
        'Failed logging in "%s"!',
        $email->asString()
    );

    return;
}

$container->session()->authenticate($user);

echo \sprintf(
    'Successfully logged in as "%s"!',
    $user->email()->asString()
);
