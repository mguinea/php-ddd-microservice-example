<?php

declare(strict_types=1);

namespace App\Role\Application\Update;

use App\Role\Domain\RoleName;
use App\Shared\Domain\Bus\Event\EventBus;
use App\Role\Domain\RoleId;
use App\Role\Domain\RoleNotFound;
use App\Role\Domain\RoleRepositoryInterface;

final class RoleUpdater
{
    public function __construct(
        private RoleRepositoryInterface $repository,
        private EventBus $bus
    )
    {
    }

    public function __invoke(RoleId $id, ?RoleName $name = null): void
    {
        $role = $this->repository->findById($id);

        if (null === $role) {
            throw new RoleNotFound();
        }

        $role->update($name);
        $this->repository->save($role);
        $this->bus->publish(...$role->pullDomainEvents());
    }
}
