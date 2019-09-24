<?php

declare(strict_types=1);

namespace Test\Specification\Authentication;

use Authentication\Entity;
use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;

final class AuthenticationContext implements Context
{
    /**
     * @Given there are no registered users
     */
    public function thereAreNoRegisteredUsers(): void
    {
        self::writeUsers([]);
    }

    /**
     * @When a user registers with the website
     */
    public function aUserRegistersWithTheWebsite(): void
    {
        $users = self::readUsers();

        $users[] = new Entity\User(
            'user@example.com',
            'super-secret-password'
        );

        self::writeUsers($users);
    }

    /**
     * @Then the user can log into the website
     */
    public function theUserCanLogIntoTheWebsite(): void
    {
        throw new PendingException();
    }

    /**
     * @Given there is a registered user
     */
    public function thereIsARegisteredUser(): void
    {
        throw new PendingException();
    }

    /**
     * @Then the user cannot log into the website with a non-matching password
     */
    public function theUserCannotLogIntoTheWebsiteWithANonMatchingPassword(): void
    {
        throw new PendingException();
    }

    private static function usersFile(): string
    {
        return __DIR__ . '/../../../data/users.txt';
    }

    private static function writeUsers(array $users): void
    {
        \file_put_contents(
            self::usersFile(),
            \serialize($users)
        );
    }

    /**
     * @return Entity\User[]
     */
    private static function readUsers(): array
    {
        if (!\file_exists(self::usersFile())) {
            return [];
        }

        $contents = \file_get_contents(self::usersFile());

        if (false === $contents) {
            return [];
        }

        return \unserialize($contents);
    }
}
