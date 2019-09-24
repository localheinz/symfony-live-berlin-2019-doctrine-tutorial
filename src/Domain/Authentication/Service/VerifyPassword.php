<?php

declare(strict_types=1);

namespace Domain\Authentication\Service;

interface VerifyPassword
{
    public function __invoke(string $password, string $passwordHash): bool;
}
