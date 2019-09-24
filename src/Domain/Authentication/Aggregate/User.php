<?php

declare(strict_types=1);

namespace Domain\Authentication\Aggregate;

use Domain\Authentication\Query\IsUserRegistered;
use Domain\Authentication\Service\HashPassword;
use Domain\Authentication\Service\VerifyPassword;
use Domain\Authentication\Value\Email;
use Domain\Authentication\Value\Password;

final class User
{
    private $email;

    private $passwordHash;

    private function __construct(Email $email, string $passwordHash)
    {
        $this->email = $email;
        $this->passwordHash = $passwordHash;
    }

    public static function register(
        IsUserRegistered $isUserRegistered,
        HashPassword $hashPassword,
        Email $email,
        Password $password
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

    public function login(VerifyPassword $verifyPassword, Password $password): bool
    {
        return $verifyPassword(
            $password,
            $this->passwordHash
        );
    }

    public static function unserializeFrom(Email $email, string $passwordHash): self
    {
        return new self(
            $email,
            $passwordHash
        );
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email->value(),
            'passwordHash' => $this->passwordHash,
        ];
    }
}
