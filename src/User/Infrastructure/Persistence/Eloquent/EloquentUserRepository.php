<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Persistence\Eloquent;

use App\Shared\Domain\Criteria\Criteria;
use App\User\Domain\User;
use App\User\Domain\UserId;
use App\User\Domain\UserRepositoryInterface;
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
            throw new EloquentException(
                $e->getMessage()
            );
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
        // TODO create an infrastructure class to convert criteria to eloquent query
        if (false === $criteria->order()->isNone()) {
            $order = $criteria->order();
            $eloquentUsers = $this->model
                ->orderBy(
                    $order->orderBy()->value(),
                    $order->orderType()->value()
                )
                ->take($criteria->limit())
                ->skip($criteria->offset())
                ->get();
        } else {
            $eloquentUsers = $this->model->all();
        }

        return array_map(function($eloquentUser) {
            return User::fromPrimitives(
                $eloquentUser['id'],
                $eloquentUser['email'],
                $eloquentUser['password']
            );
        }, $eloquentUsers->toArray());
    }
}
