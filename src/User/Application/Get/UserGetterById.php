<?php

declare(strict_types=1);

namespace App\User\Application\Get;

use App\User\Domain\User;
use App\User\Domain\UserId;
use App\User\Domain\UserNotFound;
use App\User\Domain\UserRepositoryInterface;

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
