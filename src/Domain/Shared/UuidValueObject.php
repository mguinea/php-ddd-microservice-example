<?php

declare(strict_types=1);

namespace App\Domain\Shared;

use Ramsey\Uuid\Uuid as RamseyUuid;

class UuidValueObject extends AbstractStringValueObject
{
    public static function create()
    {
        return new static(RamseyUuid::uuid4()->toString());
    }
}
