<?php

declare(strict_types=1);

namespace App\Application\User\Delete;

use App\Domain\Shared\Bus\Command\CommandHandler;
use App\Domain\User\UserId;

final class DeleteUserCommandHandler implements CommandHandler
{
    public function __construct(private UserDeletor $userDeletor)
    {
    }

    public function __invoke(DeleteUserCommand $command): void
    {
        $id = UserId::fromValue($command->id());

        $this->userDeletor->__invoke($id);
    }
}
