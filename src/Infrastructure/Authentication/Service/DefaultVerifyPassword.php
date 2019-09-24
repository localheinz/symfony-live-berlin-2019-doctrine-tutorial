<?php

declare(strict_types=1);

namespace Infrastructure\Authentication\Service;

use Domain\Authentication\Service\VerifyPassword;
use Domain\Authentication\Value\Password;
use Domain\Authentication\Value\PasswordHash;

final class DefaultVerifyPassword implements VerifyPassword
{
    public function __invoke(Password $password, PasswordHash $passwordHash): bool
    {
        return \password_verify(
            $password->value(),
            $passwordHash->value()
        );
    }
}
