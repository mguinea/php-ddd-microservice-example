<?php

declare(strict_types=1);

namespace App\Role\Application\Get;

use App\Shared\Domain\Bus\Query\Query;

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
