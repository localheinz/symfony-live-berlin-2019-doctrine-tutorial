<?php

declare(strict_types=1);

namespace Infrastructure\Authentication\Repository;

use Domain\Authentication\Entity\User;
use Domain\Authentication\Repository\Users;

final class JsonFileUsers implements Users
{
    private $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function get(string $email): User
    {
        $users = $this->loadUsersFromFile();

        if (!\array_key_exists($email, $users)) {
            throw new \RuntimeException(\sprintf(
                'User "%s" was not found.',
                $email
            ));
        }

        return $users[$email];
    }

    public function store(User $user): void
    {
        $users = $this->loadUsersFromFile();

        if (\array_key_exists($user->email(), $users)) {
            throw new \RuntimeException(\sprintf(
                'User with email "%s" is already registered.',
                $user->email()
            ));
        }

        $users[] = $user;

        $this->writeUsersToFile($users);
    }

    public function isRegistered(string $email): bool
    {
        try {
            $this->get($email);
        } catch (\RuntimeException $exception) {
            return false;
        }

        return true;
    }

    /**
     * @return User[]
     */
    private function loadUsersFromFile(): array
    {
        if (!\file_exists($this->path)) {
            return [];
        }

        $contents = \file_get_contents($this->path);

        if (false === $contents) {
            return [];
        }

        $data = \json_decode(
            $contents,
            true
        );

        if (null === $data || \JSON_ERROR_NONE !== \json_last_error()) {
            return [];
        }

        return \array_map(static function (array $item): User {
            return new User(
                $item['email'],
                $item['passwordHash'],
            );
        }, $data);
    }

    private function writeUsersToFile(array $users): void
    {
        $data = \array_combine(
            \array_map(static function (User $user): string {
                return $user->email();
            }, $users),
            \array_map(static function (User $user): array {
                return $user->toArray();
            }, $users)
        );

        \file_put_contents(
            $this->path,
            \json_encode(
                $data,
                \JSON_PRETTY_PRINT
            )
        );
    }
}
