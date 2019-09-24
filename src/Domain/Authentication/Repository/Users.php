<?php

declare(strict_types=1);

namespace Domain\Authentication\Repository;

use Domain\Authentication\Aggregate\User;
use Domain\Authentication\Value\Email;

interface Users
{
    public function get(Email $email): User;

    public function store(User $user): void;
}
