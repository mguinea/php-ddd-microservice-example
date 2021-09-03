<?php

namespace App\Domain\User;

interface UserRepository
{
    public function findById(UserId $id): ?User;

    public function save(User $user): void;
}
