<?php

declare(strict_types=1);

namespace Infrastructure\Authentication\Service;

use Domain\Authentication\Service\HashPassword;
use Domain\Authentication\Value\Password;
use Domain\Authentication\Value\PasswordHash;

final class DefaultHashPassword implements HashPassword
{
    public function __invoke(Password $password): PasswordHash
    {
        $value = \password_hash(
            $password->value(),
            \PASSWORD_DEFAULT
        );

        if (!\is_string($value)) {
            throw new \RuntimeException('Unable to hash password.');
        }

        return new PasswordHash($value);
    }
}
