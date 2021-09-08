<?php

declare(strict_types=1);

namespace App\Application\User\Update;

use App\Domain\Shared\Bus\Command\CommandHandler;
use App\Domain\User\UserEmail;
use App\Domain\User\UserId;
use App\Domain\User\UserPassword;
use App\Domain\User\UserUpdater;

final class UpdateUserCommandHandler implements CommandHandler
{
    public function __construct(private UserUpdater $updateUser)
    {
    }

    public function __invoke(UpdateUserCommand $command): void
    {
        $id = UserId::fromValue($command->id());
        $email = null === $command->email() ? null : UserEmail::fromValue($command->email());
        $password = null === $command->password() ? null : UserPassword::fromValue($command->password());

        $this->updateUser->__invoke($id, $email, $password);
    }
}
