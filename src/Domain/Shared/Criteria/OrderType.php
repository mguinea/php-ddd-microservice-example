<?php

declare(strict_types=1);

namespace App\Domain\Shared\Criteria;

use App\Domain\Shared\ValueObject\AbstractEnumValueObject;
use InvalidArgumentException;

final class OrderType extends AbstractEnumValueObject
{
    public const ASC  = 'asc';
    public const DESC = 'desc';
    public const NONE = 'none';

    protected function ensureIsBetweenAcceptedValues($value): void
    {
        $allowed = [
            self::ASC,
            self::DESC,
            self::NONE
        ];

        if (!in_array($value, $allowed, true)) {
            throw new InvalidArgumentException($value);
        }
    }
}
