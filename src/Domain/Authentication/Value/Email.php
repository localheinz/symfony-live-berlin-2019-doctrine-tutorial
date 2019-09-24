<?php

declare(strict_types=1);

namespace Domain\Authentication\Value;

final class Email
{
    private $value;

    /**
     * @param string $value
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(string $value)
    {
        if (false === \filter_var($value, \FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException(\sprintf(
                'Value "%s" does not appear to be a valid email address.',
                $value
            ));
        }

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
