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
    public function thereAreNoRegisteredUsers()
    {
        throw new PendingException();
    }

    /**
     * @When a user registers with the website
     */
    public function aUserRegistersWithTheWebsite()
    {
        throw new PendingException();
    }

    /**
     * @Then the user can log into the website
     */
    public function theUserCanLogIntoTheWebsite()
    {
        throw new PendingException();
    }

    /**
     * @Given there is a registered user
     */
    public function thereIsARegisteredUser()
    {
        throw new PendingException();
    }

    /**
     * @Then the user cannot log into the website with a non-matching password
     */
    public function theUserCannotLogIntoTheWebsiteWithANonMatchingPassword()
    {
        throw new PendingException();
    }
}
