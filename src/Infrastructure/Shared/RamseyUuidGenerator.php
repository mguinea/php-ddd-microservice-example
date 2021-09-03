<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared;

use App\Domain\Shared\UuidGenerator;
use Ramsey\Uuid\Uuid;

final class RamseyUuidGenerator implements UuidGenerator
{
    public function generate(): string
    {
        return Uuid::uuid4()->toString();
    }
}
