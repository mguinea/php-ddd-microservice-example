<?php

declare(strict_types=1);

namespace App\Role\Application\Delete;

use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Role\Domain\RoleId;

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
