<?php

declare(strict_types=1);

use Infrastructure\Authentication\Repository\JsonFileUsers;
use Infrastructure\Authentication\Service\DefaultPasswordEncoder;

require_once __DIR__ . '/../vendor/autoload.php';

$email = $_POST['emailAddress'];
$password = $_POST['password'];

$users = new JsonFileUsers(__DIR__ . '/../data/users.json');

if (!$users->isRegistered($email)) {
    echo \sprintf(
        'Failed logging in "%s"!',
        $email
    );

    return;
}

$user = $users->get($email);

$passwordEncoder = new DefaultPasswordEncoder();

if (!$user->equalsHashedPassword($password, $passwordEncoder)) {
    echo \sprintf(
        'Failed logging in "%s"!',
        $email
    );

    return;
}

\session_start();

$_SESSION['user'] = $email;

echo \sprintf(
    'Successfully logged in as "%s"!',
    $email
);
