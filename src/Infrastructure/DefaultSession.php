<?php

declare(strict_types=1);

namespace Infrastructure;

use Application\Session;
use Domain\Authentication\Aggregate\User;

final class DefaultSession implements Session
{
    public function authenticate(User $user): void
    {
        self::start();

        $_SESSION['user'] = $user->email();
    }

    public function isAuthenticated(): bool
    {
        self::start();

        return \array_key_exists('user', $_SESSION);
    }

    private static function start(): void
    {
        \session_start();
    }
}
