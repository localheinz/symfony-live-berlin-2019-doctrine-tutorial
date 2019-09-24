<?php

declare(strict_types=1);

namespace Application;

use Domain\Authentication\Repository\Users;
use Domain\Authentication\Service\HashPassword;
use Domain\Authentication\Service\VerifyPassword;

interface Container
{
    public function users(): Users;

    public function hashPassword(): HashPassword;

    public function verifyPassword(): VerifyPassword;

    public function session(): Session;
}
