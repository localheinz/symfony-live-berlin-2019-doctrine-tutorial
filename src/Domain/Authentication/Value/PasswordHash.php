<?php

declare(strict_types=1);

namespace Domain\Authentication\Value;

final class PasswordHash
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
                'Value "%s" does not appear to be a valid password hash.',
                $value
            ));
        }

        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }
}
