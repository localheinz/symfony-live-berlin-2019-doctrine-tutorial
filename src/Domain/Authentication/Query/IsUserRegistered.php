<?php

declare(strict_types=1);

namespace Domain\Authentication\Query;

use Domain\Authentication\Value\Email;

interface IsUserRegistered
{
    public function __invoke(Email $email): bool;
}
