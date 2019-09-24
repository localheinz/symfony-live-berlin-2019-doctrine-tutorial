<?php

declare(strict_types=1);

namespace Domain\Authentication\Value;

final class Password
{
    private $value;

    /**
     * @param string $value
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(string $value)
    {
        if ('' === \trim($value)) {
            throw new \InvalidArgumentException(\sprintf(
                'Value "%s" does not appear to be a valid password.',
                $value
            ));
        }

        $this->value = $value;
    }

    public function toHash(callable $callable): PasswordHash
    {
        return $callable($this->value);
    }

    public function verify(callable $callable): bool
    {
        return $callable($this->value);
    }
}
