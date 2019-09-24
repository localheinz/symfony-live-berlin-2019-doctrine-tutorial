<?php

declare(strict_types=1);

namespace Application;

use Domain\Authentication\Repository\Users;

interface Container
{
    public function users(): Users;
}
