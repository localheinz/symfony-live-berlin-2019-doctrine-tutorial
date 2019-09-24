<?php

declare(strict_types=1);

namespace Domain\Authentication\Query;

interface IsUserRegistered
{
    public function __invoke(string $email): bool;
}
