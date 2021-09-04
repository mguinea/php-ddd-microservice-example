<?php

declare(strict_types=1);

namespace App\Application\User\Delete;

use App\Domain\Shared\Bus\Command\Command;

final class DeleteUserCommand implements Command
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
