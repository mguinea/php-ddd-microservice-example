<?php

declare(strict_types=1);

namespace App\User\Application\Delete;

use App\Shared\Domain\Bus\Event\EventBus;
use App\User\Domain\UserId;
use App\User\Domain\UserNotFound;
use App\User\Domain\UserRepositoryInterface;

final class UserDeletor
{
    public function __construct(
        private UserRepositoryInterface $repository,
        private EventBus $bus
    ) {
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
