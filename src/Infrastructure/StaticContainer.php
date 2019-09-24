<?php

declare(strict_types=1);

namespace Infrastructure;

use Application\Container;
use Application\Session;
use Domain\Authentication\Query\IsUserRegistered;
use Domain\Authentication\Repository\Users;
use Domain\Authentication\Service\HashPassword;
use Domain\Authentication\Service\VerifyPassword;
use Infrastructure\Authentication\Query\DefaultIsUserRegistered;
use Infrastructure\Authentication\Repository\JsonFileUsers;
use Infrastructure\Authentication\Service\DefaultHashPassword;
use Infrastructure\Authentication\Service\DefaultVerifyPassword;

final class StaticContainer implements Container
{
    public function users(): Users
    {
        return new JsonFileUsers(__DIR__ . '/../../data/users.json');
    }

    public function hashPassword(): HashPassword
    {
        return new DefaultHashPassword();
    }

    public function verifyPassword(): VerifyPassword
    {
        return new DefaultVerifyPassword();
    }

    public function session(): Session
    {
        return new DefaultSession();
    }

    public function isUserRegistered(): IsUserRegistered
    {
        return new DefaultIsUserRegistered($this->users());
    }
}
