<?php

declare(strict_types=1);

namespace App\Application\Role\Delete;

use App\Domain\Shared\Bus\Command\CommandHandler;
use App\Domain\Role\RoleId;

final class DeleteRoleCommandHandler implements CommandHandler
{
    public function __construct(private RoleDeletor $roleDeletor)
    {
    }

    public function __invoke(DeleteRoleCommand $command): void
    {
        $id = RoleId::fromValue($command->id());

        $this->roleDeletor->__invoke($id);
    }
}
