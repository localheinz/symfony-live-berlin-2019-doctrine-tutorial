<?php

declare(strict_types=1);

namespace Test\Specification\Blog;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;

final class BlogPostContext implements Context
{
    /**
     * @Given an authenticated user
     */
    public function anAuthenticatedUser()
    {
        throw new PendingException();
    }

    /**
     * @When the user creates a new blog post
     */
    public function theUserCreatesANewBlogPost()
    {
        throw new PendingException();
    }

    /**
     * @Then the blog post can be viewed
     */
    public function theBlogPostCanBeViewed()
    {
        throw new PendingException();
    }

    /**
     * @Then the blog post author corresponds to the user that created it
     */
    public function theBlogPostAuthorCorrespondsToTheUserThatCreatedIt()
    {
        throw new PendingException();
    }

    /**
     * @Given an authenticated user and an existing blog post by another user
     */
    public function anAuthenticatedUserAndAnExistingBlogPostByAnotherUser()
    {
        throw new PendingException();
    }

    /**
     * @When the user comments on the blog post
     */
    public function theUserCommentsOnTheBlogPost()
    {
        throw new PendingException();
    }

    /**
     * @Then the blog post comment can be viewed
     */
    public function theBlogPostCommentCanBeViewed()
    {
        throw new PendingException();
    }

    /**
     * @Given an authenticated user and an existing blog post by the same user
     */
    public function anAuthenticatedUserAndAnExistingBlogPostByTheSameUser()
    {
        throw new PendingException();
    }

    /**
     * @Then the user cannot comment on the blog post
     */
    public function theUserCannotCommentOnTheBlogPost()
    {
        throw new PendingException();
    }

    /**
     * @Given an existing set of blog posts with comments
     */
    public function anExistingSetOfBlogPostsWithComments()
    {
        throw new PendingException();
    }

    /**
     * @When I view the list of commented blog posts
     */
    public function iViewTheListOfCommentedBlogPosts()
    {
        throw new PendingException();
    }

    /**
     * @Then the list of popular commented  blog posts should be sorted by comment count
     */
    public function theListOfPopularCommentedBlogPostsShouldBeSortedByCommentCount()
    {
        throw new PendingException();
    }

    /**
     * @Then the list of popular commented blog posts should be paginated
     */
    public function theListOfPopularCommentedBlogPostsShouldBePaginated()
    {
        throw new PendingException();
    }
}
