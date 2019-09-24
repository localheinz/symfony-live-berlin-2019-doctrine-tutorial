<?php

declare(strict_types=1);

use Infrastructure\DefaultContainer;

require_once __DIR__ . '/../vendor/autoload.php';

$container = new DefaultContainer();

$session = $container->session();

try {
    $user = $session->authenticatedUser();
} catch (\Exception $exception) {
    echo 'You are currently not logged in.';

    return;
}

echo \sprintf(
    'Successfully logged in as "%s"!',
    $user->email()->asString()
);
