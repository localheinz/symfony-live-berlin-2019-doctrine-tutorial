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

        $_SESSION['user'] = $user;
    }

    public function authenticatedUser(): User
    {
        self::start();

        if (!\array_key_exists('user', $_SESSION)) {
            throw new \BadMethodCallException('Currently no user is authenticated.');
        }

        $user = $_SESSION['user'];

        if (!$user instanceof User) {
            throw new \BadMethodCallException('Failed retrieving user from session.');
        }

        return $user;
    }

    private static function start(): void
    {
        \session_start();
    }
}
