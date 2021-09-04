<?php

declare(strict_types=1);

namespace App\Application\User\Update;

use App\Domain\User\UserEmail;
use App\Domain\User\UserId;
use App\Domain\User\UserNotFound;
use App\Domain\User\UserPassword;
use App\Domain\User\UserRepository;

final class UpdateUser
{
    public function __construct(private UserRepository $repository)
    {
    }

    public function __invoke(UserId $id, UserEmail $email, UserPassword $password): void
    {
        $user = $this->repository->findById($id);

        if (null === $user) {
            throw new UserNotFound();
        }

        $user->update($email, $password);
        $this->repository->save($user);
    }
}
