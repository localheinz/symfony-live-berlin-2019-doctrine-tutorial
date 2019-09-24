<?php

declare(strict_types=1);

namespace Domain\Authentication\Entity;

final class User
{
    private $email;

    private $passwordHash;

    public function __construct(string $email, string $passwordHash)
    {
        $this->email = $email;
        $this->passwordHash = $passwordHash;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function passwordHash(): string
    {
        return $this->passwordHash;
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'passwordHash' => $this->passwordHash,
        ];
    }
}
