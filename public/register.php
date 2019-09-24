<?php

declare(strict_types=1);

$email = $_POST['emailAddress'];
$password = $_POST['password'];

$usersFile = __DIR__ . '/../data/users.json';

if (!\file_exists($usersFile)) {
    return;
}

$contents = \file_get_contents($usersFile);

$users = [];

if (\is_string($contents)) {
    $users = \json_decode(
        $contents,
        true
    );

    if (null === $users && \JSON_ERROR_NONE !== \json_last_error()) {
        $users = [];
    }
}

if (\array_key_exists($email, $users)) {
    echo 'Already registered';

    return;
}

$passwordHash = \password_hash(
    $password,
    \PASSWORD_DEFAULT
);

$users[$email] = $passwordHash;

\file_put_contents(
    $usersFile,
    \json_encode(
        $users,
        \JSON_PRETTY_PRINT
    )
);

echo \sprintf(
    'Successfully registered as "%s"!',
    $email
);
