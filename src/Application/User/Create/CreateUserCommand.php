<?php

declare(strict_types=1);

namespace App\Application\User\Create;

use App\Domain\Shared\Bus\Command\Command;

final class CreateUserCommand implements Command
{
    public function __construct(
        private string $id,
        private string $email,
        private string $password
    )
    {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }
}
