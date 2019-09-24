<?php

declare(strict_types=1);

use Authentication\Entity\User;
use Authentication\Repository\JsonFileUsers;

require_once __DIR__ . '/../vendor/autoload.php';

$email = $_POST['emailAddress'];
$password = $_POST['password'];

$passwordHash = \password_hash(
    $password,
    \PASSWORD_DEFAULT
);

$users = new JsonFileUsers(__DIR__ . '/../data/users.json');

$user = new User(
    $email,
    $passwordHash
);

try {
    $users->store($user);
} catch (\RuntimeException $exception) {
    echo 'Already registered';

    return;
}

echo \sprintf(
    'Successfully registered as "%s"!',
    $email
);
