<?php

declare(strict_types=1);

namespace Domain\Authentication\Service;

interface VerifyPassword
{
    public function equals(string $password, string $passwordHash): bool;
}
