<?php

declare(strict_types=1);

namespace Application;

use Domain\Authentication\Repository\Users;
use Domain\Authentication\Service\PasswordEncoder;

interface Container
{
    public function users(): Users;

    public function passwordEncoder(): PasswordEncoder;
}
