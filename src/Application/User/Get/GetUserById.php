<?php

declare(strict_types=1);

namespace App\Application\User\Get;

use App\Domain\User\User;
use App\Domain\User\UserId;
use App\Domain\User\UserNotFound;
use App\Domain\User\UserRepository;

final class GetUserById
{
    public function __construct(private UserRepository $repository)
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
