<?php

declare(strict_types=1);

\session_start();

if (!\array_key_exists('user', $_SESSION)) {
    echo 'You are currently not logged in.';

    return;
}

$email = $_SESSION['user'];

echo \sprintf(
    'Successfully logged in as "%s"!',
    $email
);
