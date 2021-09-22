<?php

declare(strict_types=1);

namespace App\Application\Role\Update;

use App\Domain\Shared\Bus\Command\Command;

final class UpdateRoleCommand implements Command
{
    public function __construct(
        private string $id,
        private ?string $email = null,
        private ?string $password = null
    )
    {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function email(): ?string
    {
        return $this->email;
    }

    public function password(): ?string
    {
        return $this->password;
    }
}
