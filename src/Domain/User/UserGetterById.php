<?php

declare(strict_types=1);

namespace App\Domain\User;

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
