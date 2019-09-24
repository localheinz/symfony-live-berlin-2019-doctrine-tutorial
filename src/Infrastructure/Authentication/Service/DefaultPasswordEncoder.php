<?php

declare(strict_types=1);

namespace Infrastructure\Authentication\Service;

use Domain\Authentication\Service\PasswordEncoder;

final class DefaultPasswordEncoder implements PasswordEncoder
{
    public function encode(string $password): string
    {
        return \password_hash(
            $password,
            \PASSWORD_DEFAULT
        );
    }

    public function equals(string $password, string $passwordHash): bool
    {
        return \password_verify(
            $password,
            $passwordHash
        );
    }
}
