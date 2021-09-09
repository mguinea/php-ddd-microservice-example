<?php

namespace App\Domain\User;

interface UserRepositoryInterface
{
    public function deleteById(UserId $id): void;

    public function findById(UserId $id): ?User;

    public function save(User $user): void;

    public function searchByCriteria(Criteria $criteria): array;
}
