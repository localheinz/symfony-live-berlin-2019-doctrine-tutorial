<?php

declare(strict_types=1);

namespace Test\Specification\Authentication;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;

final class AuthenticationContext implements Context
{
    /**
     * @Given there are no registered users
     */
    public function thereAreNoRegisteredUsers(): void
    {
        throw new PendingException();
    }

    /**
     * @When a user registers with the website
     */
    public function aUserRegistersWithTheWebsite(): void
    {
        throw new PendingException();
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
}
