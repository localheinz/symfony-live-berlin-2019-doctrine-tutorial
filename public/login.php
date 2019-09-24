<?php

declare(strict_types=1);

use Domain\Authentication\Value\Email;
use Domain\Authentication\Value\Password;
use Infrastructure\DefaultContainer;

require_once __DIR__ . '/../vendor/autoload.php';

$email = new Email($_POST['emailAddress']);
$password = new Password($_POST['password']);

$container = new DefaultContainer();

try {
    $user = $container->users()->get($email);
} catch (\Exception $exception) {
    echo \sprintf(
        'Failed logging in "%s"!',
        $email->value()
    );

    return;
}

if (!$user->login($container->verifyPassword(), $password)) {
    echo \sprintf(
        'Failed logging in "%s"!',
        $email->value()
    );

    return;
}

$container->session()->authenticate($user);

echo \sprintf(
    'Successfully logged in as "%s"!',
    $user->email()->value()
);
