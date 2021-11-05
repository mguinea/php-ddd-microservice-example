<?php

declare(strict_types=1);

namespace App\Role\Application\Delete;

use App\Shared\Domain\Bus\Event\EventBus;
use App\Role\Domain\RoleId;
use App\Role\Domain\RoleNotFound;
use App\Role\Domain\RoleRepositoryInterface;

final class RoleDeletor
{
    public function __construct(
        private RoleRepositoryInterface $repository,
        private EventBus $bus
    )
    {
    }

    public function __invoke(RoleId $id): void
    {
        $role = $this->repository->findById($id);

        if (null === $role) {
            throw new RoleNotFound();
        }

        $this->repository->deleteById($id);
        $this->bus->publish(...$role->pullDomainEvents());
    }
}
