<?php

declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\Shared\Bus\Event\EventBus;

final class UserUpdater
{
    public function __construct(
        private UserRepositoryInterface $repository,
        private EventBus $bus
    )
    {
    }

    public function __invoke(UserId $id, ?UserEmail $email = null, ?UserPassword $password = null): void
    {
        $user = $this->repository->findById($id);

        if (null === $user) {
            throw new UserNotFound();
        }

        $user->update($email, $password);
        $this->repository->save($user);
        $this->bus->publish(...$user->pullDomainEvents());
    }
}
