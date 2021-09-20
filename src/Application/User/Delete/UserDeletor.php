<?php

declare(strict_types=1);

namespace App\Application\User\Delete;

use App\Domain\Shared\Bus\Event\EventBus;
use App\Domain\User\UserId;
use App\Domain\User\UserNotFound;
use App\Domain\User\UserRepositoryInterface;

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
