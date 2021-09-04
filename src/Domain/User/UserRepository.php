<?php

namespace App\Domain\User;

interface UserRepository
{
    public function deleteById(UserId $id): void;

    public function findById(UserId $id): ?User;

    public function save(User $user): void;
}
