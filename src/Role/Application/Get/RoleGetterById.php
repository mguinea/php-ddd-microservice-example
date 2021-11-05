<?php

declare(strict_types=1);

namespace App\Role\Application\Get;

use App\Role\Domain\Role;
use App\Role\Domain\RoleId;
use App\Role\Domain\RoleNotFound;
use App\Role\Domain\RoleRepositoryInterface;

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
