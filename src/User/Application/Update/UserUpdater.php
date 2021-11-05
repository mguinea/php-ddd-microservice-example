<?php

declare(strict_types=1);

namespace App\User\Application\Update;

use App\Shared\Domain\Bus\Event\EventBus;
use App\User\Domain\UserEmail;
use App\User\Domain\UserId;
use App\User\Domain\UserNotFound;
use App\User\Domain\UserPassword;
use App\User\Domain\UserRepositoryInterface;

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
