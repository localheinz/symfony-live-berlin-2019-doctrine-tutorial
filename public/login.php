<?php

declare(strict_types=1);

use Infrastructure\StaticContainer;

require_once __DIR__ . '/../vendor/autoload.php';

$email = $_POST['emailAddress'];
$password = $_POST['password'];

$container = new StaticContainer();

$users = $container->users();

if (!$users->isRegistered($email)) {
    echo \sprintf(
        'Failed logging in "%s"!',
        $email
    );

    return;
}

$user = $users->get($email);

$passwordEncoder = $container->passwordEncoder();

if (!$user->equalsHashedPassword($password, $passwordEncoder)) {
    echo \sprintf(
        'Failed logging in "%s"!',
        $email
    );

    return;
}

$session = $container->session();

$session->start();

$session->authenticate($user);

echo \sprintf(
    'Successfully logged in as "%s"!',
    $email
);
