<?php

namespace App\User\Domain;

use App\Shared\Domain\Criteria\Criteria;

interface UserRepositoryInterface
{
    public function deleteById(UserId $id): void;

    public function findById(UserId $id): ?User;

    public function save(User $user): void;

    public function searchByCriteria(Criteria $criteria): array;
}
