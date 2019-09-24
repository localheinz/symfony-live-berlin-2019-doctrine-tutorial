<?php

declare(strict_types=1);

namespace Application;

use Domain\Authentication\Aggregate\User;

interface Session
{
    public function authenticate(User $user): void;

    public function authenticatedUser(): User;
}
