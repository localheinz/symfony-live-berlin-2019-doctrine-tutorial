<?php

declare(strict_types=1);

namespace Domain\Authentication\Value;

final class Email
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
        if (false === \filter_var($value, \FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException(\sprintf(
                'Value "%s" does not appear to be a valid email address.',
                $value
            ));
        }

        return new self($value);
    }

    public function asString(): string
    {
        return $this->value;
    }
}
