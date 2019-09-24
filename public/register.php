<?php

declare(strict_types=1);

use Domain\Authentication\Entity\User;
use Infrastructure\Authentication\Service\DefaultPasswordEncoder;
use Infrastructure\StaticContainer;

require_once __DIR__ . '/../vendor/autoload.php';

$email = $_POST['emailAddress'];
$password = $_POST['password'];

$container = new StaticContainer();

$passwordEncoder = new DefaultPasswordEncoder();

$passwordHash = $passwordEncoder->encode($password);

$users = $container->users();

if ($users->isRegistered($email)) {
    echo 'Already registered';

    return;
}

$user = new User(
    $email,
    $passwordHash
);

$users->store($user);

echo \sprintf(
    'Successfully registered as "%s"!',
    $email
);
