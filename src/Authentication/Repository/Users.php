<?php

declare(strict_types=1);

namespace Authentication\Repository;

use Authentication\Entity\User;

interface Users
{
    public function get(string $email): User;

    public function store(User $user): void;

    public function isRegistered(string $email): bool;
}
