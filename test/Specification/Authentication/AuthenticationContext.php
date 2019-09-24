<?php

declare(strict_types=1);

namespace Test\Specification\Authentication;

use Authentication\Entity;
use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;

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
        self::httpClient()->post(
            '/register.php',
            [
                RequestOptions::FORM_PARAMS => [
                    'emailAddress' => 'user@example.com',
                    'password' => 'hallo123',
                ],
            ]
        );
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
        return __DIR__ . '/../../../data/users.json';
    }

    private static function writeUsers(array $users): void
    {
        \file_put_contents(
            self::usersFile(),
            \json_encode(
                $users,
                \JSON_PRETTY_PRINT
            )
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

        $users = \json_decode($contents);

        if (null === $users && \JSON_ERROR_NONE !== \json_last_error()) {
            return [];
        }

        return $users;
    }

    private static function httpClient(): ClientInterface
    {
        return new Client([
            'base_uri' => 'http://localhost:8080',
        ]);
    }
}
