<?php

declare(strict_types=1);

namespace Infrastructure;

use Application\Container;
use Application\Session;
use Domain\Authentication\Repository\Users;
use Domain\Authentication\Service\PasswordEncoder;
use Infrastructure\Authentication\Repository\JsonFileUsers;
use Infrastructure\Authentication\Service\DefaultPasswordEncoder;

final class StaticContainer implements Container
{
    public function users(): Users
    {
        return new JsonFileUsers(__DIR__ . '/../../data/users.json');
    }

    public function passwordEncoder(): PasswordEncoder
    {
        return new DefaultPasswordEncoder();
    }

    public function session(): Session
    {
        return new DefaultSession();
    }
}
