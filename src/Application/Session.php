<?php

declare(strict_types=1);

namespace Application;

use Domain\Authentication\Aggregate\User;

interface Session
{
    public function authenticate(User $user);

    public function isAuthenticated(): bool;
}
