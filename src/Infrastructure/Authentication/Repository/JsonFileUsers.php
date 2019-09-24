<?php

declare(strict_types=1);

namespace Infrastructure\Authentication\Repository;

use Domain\Authentication\Aggregate\User;
use Domain\Authentication\Repository\Users;
use Domain\Authentication\Value\Email;
use Domain\Authentication\Value\PasswordHash;

final class JsonFileUsers implements Users
{
    private $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function get(Email $email): User
    {
        $users = $this->loadUsersFromFile();

        if (!\array_key_exists($email->value(), $users)) {
            throw new \RuntimeException(\sprintf(
                'User "%s" was not found.',
                $email->value()
            ));
        }

        return $users[$email->value()];
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
            return User::unserializeFrom(
                new Email($item['email']),
                new PasswordHash($item['passwordHash'])
            );
        }, $data);
    }

    private function writeUsersToFile(array $users): void
    {
        $data = \array_combine(
            \array_map(static function (User $user): string {
                return $user->email()->value();
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
