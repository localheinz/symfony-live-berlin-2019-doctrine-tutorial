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
        $faker = $this->faker();

        $email = $faker->email;
        $password = $faker->sha1;

        $user = new User(
            $email,
            $password
        );

        self::assertSame($email, $user->email());
        self::assertSame($password, $user->password());
    }
}
