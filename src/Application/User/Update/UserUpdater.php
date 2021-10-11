<?php

declare(strict_types=1);

namespace App\Application\User\Update;

use App\Domain\Shared\Bus\Event\EventBus;
use App\Domain\User\UserEmail;
use App\Domain\User\UserId;
use App\Domain\User\UserNotFound;
use App\Domain\User\UserPassword;
use App\Domain\User\UserRepositoryInterface;

final class UserUpdater
{
    public function __construct(
        private UserRepositoryInterface $repository,
        private EventBus $bus
    ) {
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
