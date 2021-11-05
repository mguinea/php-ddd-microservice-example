<?php

declare(strict_types=1);

namespace App\User\Application\Update;

use App\Shared\Domain\Bus\Command\CommandHandler;
use App\User\Domain\UserEmail;
use App\User\Domain\UserId;
use App\User\Domain\UserPassword;

final class UpdateUserCommandHandler implements CommandHandler
{
    public function __construct(private UserUpdater $userUpdater)
    {
    }

    public function __invoke(UpdateUserCommand $command): void
    {
        $id = UserId::fromValue($command->id());
        $email = null === $command->email() ? null : UserEmail::fromValue($command->email());
        $password = null === $command->password() ? null : UserPassword::fromValue($command->password());

        $this->userUpdater->__invoke($id, $email, $password);
    }
}
