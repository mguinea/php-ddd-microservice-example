<?php

declare(strict_types=1);

namespace App\Domain\Permission;

final class Permission
{
    public function __construct(
        private PermissionId $id,
        private PermissionName $name,
        private array $usersId,
        private array $rolesId
    )
    {
    }

    public function id(): PermissionId
    {
        return $this->id;
    }

    public function name(): PermissionName
    {
        return $this->name;
    }

    public function usersId(): array
    {
        return $this->usersId;
    }

    public function rolesId(): array
    {
        return $this->rolesId;
    }
}
