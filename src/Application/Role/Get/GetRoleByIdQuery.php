<?php

declare(strict_types=1);

namespace App\Application\Role\Get;

use App\Domain\Shared\Bus\Query\Query;

final class GetRoleByIdQuery implements Query
{
    public function __construct(private string $id)
    {
    }

    public function id(): string
    {
        return $this->id;
    }
}
