<?php

declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\Shared\Bus\Event\EventBus;

final class UserDeletor
{
    public function __construct(
        private UserRepositoryInterface $repository,
        private EventBus $bus
    )
    {
    }

    public function __invoke(UserId $id): void
    {
        $user = $this->repository->findById($id);

        if (null === $user) {
            throw new UserNotFound();
        }

        $this->repository->deleteById($id);
        $this->bus->publish(...$user->pullDomainEvents());
    }
}
