<?php

declare(strict_types=1);

use Infrastructure\StaticContainer;

require_once __DIR__ . '/../vendor/autoload.php';

$container = new StaticContainer();

$session = $container->session();

try {
    $user = $session->authenticatedUser();
} catch (\Exception $exception) {
    echo 'You are currently not logged in.';

    return;
}

echo \sprintf(
    'Successfully logged in as "%s"!',
    $user->email()->value()
);
