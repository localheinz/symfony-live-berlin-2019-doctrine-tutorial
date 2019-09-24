<?php

declare(strict_types=1);

namespace Domain\Authentication\Value;

final class Password
{
    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @param string $value
     *
     * @throws \InvalidArgumentException
     */
    public static function fromString(string $value): self
    {
        if ('' === \trim($value)) {
            throw new \InvalidArgumentException(\sprintf(
                'Value "%s" does not appear to be a valid password.',
                $value
            ));
        }

        return new self($value);
    }

    public function asHash(callable $asHash): PasswordHash
    {
        return $asHash($this->value);
    }

    public function verify(callable $verify): bool
    {
        return $verify($this->value);
    }
}
