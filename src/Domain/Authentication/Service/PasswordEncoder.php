<?php

declare(strict_types=1);

namespace Domain\Authentication\Service;

interface PasswordEncoder
{
    public function encode(string $password): string;

    public function equals(string $password, string $passwordHash): bool;
}
