<?php

declare(strict_types=1);

namespace App\Role\Application\Create;

use App\Shared\Domain\Bus\Event\EventBus;
use App\Role\Domain\Role;
use App\Role\Domain\RoleId;
use App\Role\Domain\RoleName;
use App\Role\Domain\RoleRepositoryInterface;

final class RoleCreator
{
    public function __construct(
        private RoleRepositoryInterface $repository,
        private EventBus $bus
    ) {
    }

    public function __invoke(RoleId $id, RoleName $name): void
    {
        $role = Role::create($id, $name);

        $this->repository->save($role);
        $this->bus->publish(...$role->pullDomainEvents());
    }
}
