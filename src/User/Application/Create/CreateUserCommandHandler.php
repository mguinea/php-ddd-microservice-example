<?php

declare(strict_types=1);

namespace App\User\Application\Create;

use App\Shared\Domain\Bus\Command\CommandHandler;
use App\User\Domain\UserEmail;
use App\User\Domain\UserId;
use App\User\Domain\UserPassword;

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
