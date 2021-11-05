<?php

declare(strict_types=1);

namespace App\User\Application\Delete;

use App\Shared\Domain\Bus\Command\CommandHandler;
use App\User\Domain\UserId;

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
