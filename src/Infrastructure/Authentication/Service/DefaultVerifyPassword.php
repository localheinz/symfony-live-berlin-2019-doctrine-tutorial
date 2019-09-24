<?php

declare(strict_types=1);

namespace Infrastructure\Authentication\Service;

use Domain\Authentication\Service\VerifyPassword;

final class DefaultVerifyPassword implements VerifyPassword
{
    public function __invoke(string $password, string $passwordHash): bool
    {
        return \password_verify(
            $password,
            $passwordHash
        );
    }
}
