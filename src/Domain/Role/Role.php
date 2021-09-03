<?php

declare(strict_types=1);

namespace App\Domain\Role;

final class Role
{
    public function __construct(
        private RoleId $id,
        private RoleName $name,
        private array $usersId,
        private array $permissionsId
    )
    {
    }

    public function id(): RoleId
    {
        return $this->id;
    }

    public function name(): RoleName
    {
        return $this->name;
    }

    public function usersId(): array
    {
        return $this->usersId;
    }

    public function permissionsId(): array
    {
        return $this->permissionsId;
    }
}
