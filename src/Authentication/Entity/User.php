<?php

declare(strict_types=1);

namespace Authentication\Entity;

final class User
{
    private $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function email(): string
    {
        return $this->email;
    }
}
