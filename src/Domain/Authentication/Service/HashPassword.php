<?php

declare(strict_types=1);

namespace Domain\Authentication\Service;

use Domain\Authentication\Value\Password;
use Domain\Authentication\Value\PasswordHash;

interface HashPassword
{
    public function __invoke(Password $password): PasswordHash;
}
