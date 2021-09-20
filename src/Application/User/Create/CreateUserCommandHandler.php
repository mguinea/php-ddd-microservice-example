<?php

declare(strict_types=1);

namespace App\Application\User\Create;

use App\Domain\Shared\Bus\Command\CommandHandler;
use App\Domain\User\UserEmail;
use App\Domain\User\UserId;
use App\Domain\User\UserPassword;

final class CreateUserCommandHandler implements CommandHandler
{
    public function __construct(private UserCreator $userCreator)
    {
    }

    public function __invoke(CreateUserCommand $command): void
    {
        $id = UserId::fromValue($command->id());
        $email = UserEmail::fromValue($command->email());
        $password = UserPassword::fromValue($command->password());

        $this->userCreator->__invoke($id, $email, $password);
    }
}
