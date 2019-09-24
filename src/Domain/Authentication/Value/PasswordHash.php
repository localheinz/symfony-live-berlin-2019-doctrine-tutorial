<?php

declare(strict_types=1);

namespace Domain\Authentication\Value;

final class PasswordHash
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
                'Value "%s" does not appear to be a valid password hash.',
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
