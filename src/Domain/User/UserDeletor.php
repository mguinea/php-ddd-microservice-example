<?php

declare(strict_types=1);

namespace App\Domain\User;

final class UserDeletor
{
    public function __construct(private UserRepositoryInterface $repository)
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
