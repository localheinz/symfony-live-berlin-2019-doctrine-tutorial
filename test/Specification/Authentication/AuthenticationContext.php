<?php

declare(strict_types=1);

namespace Test\Specification\Authentication;

use Behat\Behat\Context\Context;
use Domain\Authentication\Entity\User;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use PHPUnit\Framework\Assert;
use Psr\Http\Message\ResponseInterface;

final class AuthenticationContext implements Context
{
    /**
     * @var null|ClientInterface
     */
    private static $httpClient;

    /**
     * @BeforeScenario
     */
    public function cleanDatabase(): void
    {
        if (!\file_exists(self::usersFile())) {
            return;
        }

        \unlink(self::usersFile());
    }

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
        $email = 'user@example.com';
        $password = 'hallo123';

        /** @var ResponseInterface $response */
        $response = self::httpClient()->post(
            '/register.php',
            [
                RequestOptions::FORM_PARAMS => [
                    'emailAddress' => $email,
                    'password' => $password,
                ],
            ]
        );

        $contents = $response->getBody()->getContents();

        $expected = \sprintf(
            'Successfully registered as "%s"!',
            $email
        );

        Assert::assertContains($expected, $contents, \sprintf(
            'Failed asserting that user "%s" can register with password "%s".',
            $email,
            $password
        ));
    }

    /**
     * @Then the user can log into the website
     */
    public function theUserCanLogIntoTheWebsite(): void
    {
        $email = 'user@example.com';
        $password = 'hallo123';

        /** @var ResponseInterface $response */
        $response = self::httpClient()->post(
            '/login.php',
            [
                RequestOptions::FORM_PARAMS => [
                    'emailAddress' => $email,
                    'password' => $password,
                ],
            ]
        );

        $contents = $response->getBody()->getContents();

        $expected = \sprintf(
            'Successfully logged in as "%s"!',
            $email
        );

        Assert::assertContains($expected, $contents, \sprintf(
            'Failed asserting that user "%s" can log in with password "%s".',
            $email,
            $password
        ));

        $email = 'user@example.com';

        /** @var ResponseInterface $response */
        $response = self::httpClient()->get('/index.php');

        $contents = $response->getBody()->getContents();

        $expected = \sprintf(
            'Successfully logged in as "%s"!',
            $email
        );

        Assert::assertContains($expected, $contents, \sprintf(
            'Failed asserting that user "%s" can log in with password "%s".',
            $email,
            $password
        ));
    }

    /**
     * @Given there is a registered user
     */
    public function thereIsARegisteredUser(): void
    {
        $this->aUserRegistersWithTheWebsite();
    }

    /**
     * @Then the user cannot log into the website with a non-matching password
     */
    public function theUserCannotLogIntoTheWebsiteWithANonMatchingPassword(): void
    {
        $email = 'user@example.com';
        $password = 'password123';

        /** @var ResponseInterface $response */
        $response = self::httpClient()->post(
            '/login.php',
            [
                RequestOptions::FORM_PARAMS => [
                    'emailAddress' => $email,
                    'password' => $password,
                ],
            ]
        );

        $contents = $response->getBody()->getContents();

        $expected = \sprintf(
            'Failed logging in "%s"!',
            $email
        );

        Assert::assertContains($expected, $contents, \sprintf(
            'Failed asserting that user "%s" cannot log in with password "%s".',
            $email,
            $password
        ));
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
     * @return User[]
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
        if (null === self::$httpClient) {
            self::$httpClient = new Client([
                'base_uri' => 'http://localhost:8080',
                'cookies' => true,
            ]);
        }

        return self::$httpClient;
    }
}
