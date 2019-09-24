<?php

declare(strict_types=1);

$email = $_POST['emailAddress'];
$password = $_POST['password'];

$usersFile = __DIR__ . '/../data/users.json';

if (!\file_exists($usersFile)) {
    return;
}

$contents = \file_get_contents($usersFile);

if (false === $contents) {
    return;
}

$users = \json_decode(
    $contents,
    true
);

if (!\array_key_exists($email, $users)) {
    echo 'Login failed';

    return;
}

if (!\password_verify($password, $users[$email])) {
    echo 'Login failed';

    return;
}

\session_start();

$_SESSION['user'] = $email;

echo \sprintf(
    'Successfully logged in as "%s"!',
    $email
);
