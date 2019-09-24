<?php

declare(strict_types=1);

use Domain\Authentication\Value\Email;
use Infrastructure\StaticContainer;

require_once __DIR__ . '/../vendor/autoload.php';

$email = new Email($_POST['emailAddress']);
$password = $_POST['password'];

$container = new StaticContainer();

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
