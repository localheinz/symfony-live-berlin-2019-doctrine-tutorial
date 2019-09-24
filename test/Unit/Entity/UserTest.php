<?php

declare(strict_types=1);

namespace Test\Unit\Entity;

use Authentication\Entity\User;
use Localheinz\Test\Util\Helper;
use PHPUnit\Framework;

/**
 * @covers \Authentication\Entity\User
 *
 * @internal
 */
final class UserTest extends Framework\TestCase
{
    use Helper;

    public function testConstructorSetsValues(): void
    {
        $faker = self::faker();

        $email = $faker->email;

        $user = new User($email);

        self::assertSame($email, $user->email());
    }
}
