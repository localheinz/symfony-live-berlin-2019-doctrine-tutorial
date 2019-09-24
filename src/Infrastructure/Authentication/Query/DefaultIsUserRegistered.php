<?php

declare(strict_types=1);

namespace Infrastructure\Authentication\Query;

use Domain\Authentication\Query\IsUserRegistered;
use Domain\Authentication\Repository\Users;
use Domain\Authentication\Value\Email;

final class DefaultIsUserRegistered implements IsUserRegistered
{
    private $users;

    public function __construct(Users $users)
    {
        $this->users = $users;
    }

    public function __invoke(Email $email): bool
    {
        try {
            $this->users->get($email);
        } catch (\RuntimeException $exception) {
            return false;
        }

        return true;
    }
}
