<?php

declare(strict_types=1);

namespace App\Application\User\Delete;

use App\Domain\User\UserId;
use App\Domain\User\UserNotFound;
use App\Domain\User\UserRepository;

final class DeleteUser
{
    public function __construct(private UserRepository $repository)
    {
    }

    public function __invoke(UserId $id): void
    {
        $user = $this->repository->findById($id);

        if (null === $user) {
            throw new UserNotFound();
        }

        $this->repository->deleteById($id);
    }
}
