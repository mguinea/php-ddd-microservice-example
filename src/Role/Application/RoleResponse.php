<?php

declare(strict_types=1);

namespace App\Role\Application;

use App\Shared\Domain\Bus\Query\Response;
use App\Role\Domain\Role;

final class RoleResponse implements Response
{
    public function __construct(
        private string $id,
        private string $name
    )
    {
    }

    public static function fromRole(Role $role): self
    {
        return new self(
            $role->id()->value(),
            $role->name()->value()
        );
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function toArray(): array
    {
        return [
            'role' => [
                'id' => $this->id,
                'name' => $this->name
            ]
        ];
    }
}
