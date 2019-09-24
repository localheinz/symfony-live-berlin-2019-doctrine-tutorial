<?php

declare(strict_types=1);

namespace Domain\Authentication\Repository;

use Domain\Authentication\Aggregate\User;

interface Users
{
    public function get(string $email): User;

    public function store(User $user): void;

    public function isRegistered(string $email): bool;
}
