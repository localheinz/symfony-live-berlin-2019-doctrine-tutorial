<?php

declare(strict_types=1);

namespace Infrastructure;

use Application\Container;
use Domain\Authentication\Repository\Users;
use Infrastructure\Authentication\Repository\JsonFileUsers;

final class StaticContainer implements Container
{
    public function users(): Users
    {
        return new JsonFileUsers(__DIR__ . '/../../data/users.json');
    }
}
