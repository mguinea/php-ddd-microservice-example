<?php

namespace App\Role\Domain;

use App\Shared\Domain\Criteria\Criteria;

interface RoleRepositoryInterface
{
    public function deleteById(RoleId $id): void;

    public function findById(RoleId $id): ?Role;

    public function save(Role $user): void;

    public function searchByCriteria(Criteria $criteria): array;
}
