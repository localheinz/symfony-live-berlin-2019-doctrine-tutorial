<?php

declare(strict_types=1);

namespace Infrastructure\Authentication\DBAL\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\StringType;
use Domain\Authentication\Value\Email;

final class EmailType extends StringType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        if ($value instanceof Email) {
            return $value->asString();
        }

        throw ConversionException::conversionFailed(
            $value,
            'string'
        );
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $converted = parent::convertToPHPValue(
            $value,
            $platform
        );

        if (null === $converted) {
            return null;
        }

        try {
            $email = Email::fromString($converted);
        } catch (\InvalidArgumentException $exception) {
            throw ConversionException::conversionFailed(
                $value,
                Email::class
            );
        }

        return $email;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
