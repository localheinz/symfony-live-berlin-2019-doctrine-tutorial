<?php

declare(strict_types=1);

namespace Infrastructure;

use Application\Session;
use Domain\Authentication\Entity\User;

final class DefaultSession implements Session
{
    public function start(): void
    {
        \session_start();
    }

    public function authenticate(User $user): void
    {
        $_SESSION['user'] = $user->email();
    }

    public function isAuthenticated(): bool
    {
        return \array_key_exists('user', $_SESSION);
    }
}
