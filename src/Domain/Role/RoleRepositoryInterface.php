<?php

namespace App\Domain\Role;

interface RoleRepositoryInterface
{
    public function deleteById(RoleId $id): void;

    public function findById(RoleId $id): ?Role;

    public function save(Role $user): void;

    public function searchByCriteria(Criteria $criteria): array;
}
