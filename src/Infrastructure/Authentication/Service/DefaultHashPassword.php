<?php

declare(strict_types=1);

namespace Infrastructure\Authentication\Service;

use Domain\Authentication\Service\HashPassword;

final class DefaultHashPassword implements HashPassword
{
    public function encode(string $password): string
    {
        return \password_hash(
            $password,
            \PASSWORD_DEFAULT
        );
    }
}
