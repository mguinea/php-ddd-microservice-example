<?php

declare(strict_types=1);

namespace App\Application\Role\Update;

use App\Domain\Role\RoleName;
use App\Domain\Shared\Bus\Event\EventBus;
use App\Domain\Role\RoleEmail;
use App\Domain\Role\RoleId;
use App\Domain\Role\RoleNotFound;
use App\Domain\Role\RolePassword;
use App\Domain\Role\RoleRepositoryInterface;

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
