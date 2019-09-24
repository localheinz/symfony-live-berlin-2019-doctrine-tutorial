<?php

declare(strict_types=1);

namespace Infrastructure\Authentication\Query;

use Domain\Authentication\Query\IsUserRegistered;
use Domain\Authentication\Repository\Users;

final class DefaultIsUserRegistered implements IsUserRegistered
{
    private $users;

    public function __construct(Users $users)
    {
        $this->users = $users;
    }

    public function __invoke(string $email): bool
    {
        return $this->users->isRegistered($email);
    }
}
