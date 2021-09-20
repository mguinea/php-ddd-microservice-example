<?php

declare(strict_types=1);

namespace App\Application\User\Create;

use App\Domain\Shared\Bus\Event\EventBus;
use App\Domain\User\User;
use App\Domain\User\UserEmail;
use App\Domain\User\UserId;
use App\Domain\User\UserPassword;
use App\Domain\User\UserRepositoryInterface;

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
