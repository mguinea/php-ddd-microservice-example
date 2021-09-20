<?php

declare(strict_types=1);

namespace App\Application\User\Get;

use App\Domain\User\User;
use App\Domain\User\UserId;
use App\Domain\User\UserNotFound;
use App\Domain\User\UserRepositoryInterface;

final class UserGetterById
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    public function __invoke(UserId $id): User
    {
        $user = $this->repository->findById($id);

        if (null === $user) {
            throw new UserNotFound();
        }

        return $user;
    }
}
