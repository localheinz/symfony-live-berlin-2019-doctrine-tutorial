<?php

declare(strict_types=1);

namespace Infrastructure;

use Application\Session;
use Domain\Authentication\Entity\User;

final class DefaultSession implements Session
{
    public function authenticate(User $user): void
    {
        $this->start();

        $_SESSION['user'] = $user->email();
    }

    public function isAuthenticated(): bool
    {
        $this->start();

        return \array_key_exists('user', $_SESSION);
    }

    private function start(): void
    {
        \session_start();
    }
}
