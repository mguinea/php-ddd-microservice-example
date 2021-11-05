<?php

declare(strict_types=1);

namespace App\User\Application\Delete;

use App\Shared\Domain\Bus\Command\Command;

final class DeleteUserCommand implements Command
{
    public function __construct(
        private string $id
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }
}
