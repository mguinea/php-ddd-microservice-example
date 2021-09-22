<?php

declare(strict_types=1);

namespace App\Application\Role\Get;

use App\Domain\Role\Role;
use App\Domain\Role\RoleId;
use App\Domain\Role\RoleNotFound;
use App\Domain\Role\RoleRepositoryInterface;

final class RoleGetterById
{
    public function __construct(private RoleRepositoryInterface $repository)
    {
    }

    public function __invoke(RoleId $id): Role
    {
        $role = $this->repository->findById($id);

        if (null === $role) {
            throw new RoleNotFound();
        }

        return $role;
    }
}
