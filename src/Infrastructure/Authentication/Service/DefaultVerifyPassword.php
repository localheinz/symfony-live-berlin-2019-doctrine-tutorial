<?php

declare(strict_types=1);

namespace Infrastructure\Authentication\Service;

use Domain\Authentication\Service\VerifyPassword;
use Domain\Authentication\Value\Password;

final class DefaultVerifyPassword implements VerifyPassword
{
    public function __invoke(Password $password, string $passwordHash): bool
    {
        return \password_verify(
            $password->value(),
            $passwordHash
        );
    }
}
