<?php

declare(strict_types=1);

namespace App\User\Application\Get;

use App\Shared\Domain\Bus\Query\Query;

final class GetUserByIdQuery implements Query
{
    public function __construct(private string $id)
    {
    }

    public function id(): string
    {
        return $this->id;
    }
}
