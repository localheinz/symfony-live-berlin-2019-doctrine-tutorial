<?php

declare(strict_types=1);

namespace Domain\Authentication\Service;

interface HashPassword
{
    public function __invoke(string $password): string;
}
