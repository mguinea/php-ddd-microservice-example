<?php

declare(strict_types=1);

namespace App\Role\Domain;

use App\Shared\Domain\AbstractAggregateRoot;

final class Role extends AbstractAggregateRoot
{
    public function __construct(
        private RoleId $id,
        private RoleName $name
    ) {
    }

    public static function create(RoleId $id, RoleName $name): self
    {
        return new self(
            $id,
            $name
        );
    }

    public function update(?RoleName $name = null): void
    {
        $this->name = $name ?? $this->name;
    }

    public static function fromPrimitives(string $id, string $name): self
    {
        return new self(
            RoleId::fromValue($id),
            RoleName::fromValue($name)
        );
    }

    public function id(): RoleId
    {
        return $this->id;
    }

    public function name(): RoleName
    {
        return $this->name;
    }
}
