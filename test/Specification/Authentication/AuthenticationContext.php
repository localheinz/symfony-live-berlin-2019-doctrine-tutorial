<?php

declare(strict_types=1);

namespace Test\Specification\Authentication;

use Application\Container;
use Behat\Behat\Context\Context;
use Domain\Authentication\Aggregate\User;
use Domain\Authentication\Repository\Users;
use Domain\Authentication\Value\Email;
use Domain\Authentication\Value\Password;
use Infrastructure\DefaultContainer;
use PHPUnit\Framework\Assert;

final class AuthenticationContext implements Context
{
    /**
     * @var Container
     */
    private $container;

    public function __construct()
    {
        $this->container = new DefaultContainer();
    }

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
        $user = User::register(
            $this->container->isUserRegistered(),
            $this->container->hashPassword(),
            Email::fromString('user@example.com'),
            Password::fromString('hallo123')
        );

        $this->container->users()->store($user);
    }

    /**
     * @Then the user can log into the website
     */
    public function theUserCanLogIntoTheWebsite(): void
    {
        $user = $this->container->users()->get(Email::fromString('user@example.com'));

        Assert::assertTrue($user->login(
            $this->container->verifyPassword(),
            Password::fromString('hallo123')
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
        $user = $this->container->users()->get(Email::fromString('user@example.com'));

        Assert::assertFalse($user->login(
            $this->container->verifyPassword(),
            Password::fromString('password123')
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
}
