<?php

declare(strict_types=1);

namespace App\Application\User;

use App\Domain\Shared\Bus\Query\Response;

final class UsersResponse implements Response
{
    public function toArray(): array
    {
        return [];
    }
}
