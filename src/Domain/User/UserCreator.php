<?php

declare(strict_types=1);

namespace App\Domain\User;

final class UserCreator
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    public function __invoke(UserId $id, UserEmail $email, UserPassword $password): void
    {
        $user = User::create($id, $email, $password);

        $this->repository->save($user);
    }
}
