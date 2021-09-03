<?php

declare(strict_types=1);

namespace App\Infrastructure\User\Persistence\Eloquent;

use App\Domain\User\User;
use App\Domain\User\UserId;
use App\Domain\User\UserRepository;

final class EloquentUserRepository implements UserRepository
{
    public function __construct(private EloquentUser $model)
    {
    }

    public function findById(UserId $id): ?User
    {
        $eloquentUser = $this->model->find($id->value());

        if (null === $eloquentUser) {
            return null;
        }

        return User::fromPrimitives(
            $eloquentUser->id,
            $eloquentUser->email,
            $eloquentUser->password
        );
    }

    public function save(User $user): void
    {
        $eloquentUser = new EloquentUser();
        $eloquentUser->id = $user->id()->value();
        $eloquentUser->email = $user->email()->value();
        $eloquentUser->password = $user->password()->value();

        $eloquentUser->save();
    }
}
