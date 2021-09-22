<?php

declare(strict_types=1);

namespace App\Application\Role\Create;

use App\Domain\Shared\Bus\Event\EventBus;
use App\Domain\Role\Role;
use App\Domain\Role\RoleId;
use App\Domain\Role\RoleName;
use App\Domain\Role\RoleRepositoryInterface;

final class RoleCreator
{
    public function __construct(
        private RoleRepositoryInterface $repository,
        private EventBus $bus
    )
    {
    }

    public function __invoke(RoleId $id, RoleName $name): void
    {
        $role = Role::create($id, $name);

        $this->repository->save($role);
        $this->bus->publish(...$role->pullDomainEvents());
    }
}
