<?php

declare(strict_types=1);

namespace App\Infrastructure\User\Persistence\Eloquent;

use App\Domain\User\User;
use App\Domain\User\UserId;
use App\Domain\User\UserRepositoryInterface;
use Exception;

final class EloquentUserRepository implements UserRepositoryInterface
{
    public function __construct(private EloquentUser $model)
    {
    }

    public function deleteById(UserId $id): void
    {
        try {
            $eloquentUser = $this->model->find($id->value());
            $eloquentUser->delete();
        } catch(Exception $e) {
            throw new EloquentException();
        }
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
        $eloquentUser = $this->model->find($user->id()->value());

        if (null === $eloquentUser) {
            $eloquentUser = new EloquentUser();
        }

        $eloquentUser->id = $user->id()->value();
        $eloquentUser->email = $user->email()->value();
        $eloquentUser->password = $user->password()->value();

        $eloquentUser->save();
    }

    public function searchByCriteria(Criteria $criteria): array
    {

    }
}
