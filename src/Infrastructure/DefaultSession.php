<?php

declare(strict_types=1);

namespace Infrastructure;

use Application\Session;

final class DefaultSession implements Session
{
    public function start(): void
    {
        \session_start();
    }
}
