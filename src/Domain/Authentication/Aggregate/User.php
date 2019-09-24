<?php

declare(strict_types=1);

namespace Domain\Authentication\Aggregate;

use Domain\Authentication\Query\IsUserRegistered;
use Domain\Authentication\Service\HashPassword;
use Domain\Authentication\Service\VerifyPassword;

final class User
{
    private $email;

    private $passwordHash;

    private function __construct(string $email, string $passwordHash)
    {
        $this->email = $email;
        $this->passwordHash = $passwordHash;
    }

    public static function register(
        IsUserRegistered $isUserRegistered,
        HashPassword $hashPassword,
        string $email,
        string $password
    ): self {
        if ($isUserRegistered($email)) {
            throw new \RuntimeException(\sprintf(
                'User with email "%s" has already been registered.',
                $email
            ));
        }

        return new self(
            $email,
            $hashPassword($password)
        );
    }

    public function login(VerifyPassword $verifyPassword, string $password): bool
    {
        return $verifyPassword(
            $password,
            $this->passwordHash
        );
    }

    public static function unserializeFrom(string $email, string $passwordHash): self
    {
        return new self(
            $email,
            $passwordHash
        );
    }

    public function email(): string
    {
        return $this->email;
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'passwordHash' => $this->passwordHash,
        ];
    }
}
