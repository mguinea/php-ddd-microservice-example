<?php

declare(strict_types=1);

namespace App\Application\Role\Delete;

use App\Domain\Shared\Bus\Event\EventBus;
use App\Domain\Role\RoleId;
use App\Domain\Role\RoleNotFound;
use App\Domain\Role\RoleRepositoryInterface;

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
