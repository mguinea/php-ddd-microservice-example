<?php

declare(strict_types=1);

namespace App\Role\Application\Delete;

use App\Shared\Domain\Bus\Command\Command;

final class DeleteRoleCommand implements Command
{
    public function __construct(
        private string $id
    )
    {
    }

    public function id(): string
    {
        return $this->id;
    }
}
