<?php

declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\Shared\Bus\Event\EventBus;

final class UserCreator
{
    public function __construct(
        private UserRepositoryInterface $repository,
        private EventBus $bus
    )
    {
    }

    public function __invoke(UserId $id, UserEmail $email, UserPassword $password): void
    {
        $user = User::create($id, $email, $password);

        $this->repository->save($user);
        $this->bus->publish(...$user->pullDomainEvents());
    }
}
