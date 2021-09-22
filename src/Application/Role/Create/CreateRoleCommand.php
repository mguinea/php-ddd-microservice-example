<?php

declare(strict_types=1);

namespace App\Application\Role\Create;

use App\Domain\Shared\Bus\Command\Command;

final class CreateRoleCommand implements Command
{
    public function __construct(
        private string $id,
        private string $name
    )
    {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }
}
