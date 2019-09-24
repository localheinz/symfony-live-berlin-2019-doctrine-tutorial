<?php

declare(strict_types=1);

namespace Infrastructure\Authentication\Service;

use Domain\Authentication\Service\HashPassword;
use Domain\Authentication\Value\Password;

final class DefaultHashPassword implements HashPassword
{
    public function __invoke(Password $password): string
    {
        return \password_hash(
            $password->value(),
            \PASSWORD_DEFAULT
        );
    }
}
