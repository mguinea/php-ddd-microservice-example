<?php

declare(strict_types=1);

namespace App\User\Application\Create;

use App\Shared\Domain\Bus\Event\EventBus;
use App\User\Domain\User;
use App\User\Domain\UserEmail;
use App\User\Domain\UserId;
use App\User\Domain\UserPassword;
use App\User\Domain\UserRepositoryInterface;

final class UserCreator
{
    public function __construct(
        private UserRepositoryInterface $repository,
        private EventBus $bus
    ) {
    }

    public function __invoke(UserId $id, UserEmail $email, UserPassword $password): void
    {
        $user = User::create($id, $email, $password);

        $this->repository->save($user);
        $this->bus->publish(...$user->pullDomainEvents());
    }
}
