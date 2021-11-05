<?php

declare(strict_types=1);

namespace App\Role\Application\Update;

use App\Role\Domain\RoleName;
use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Role\Domain\RoleId;

final class UpdateRoleCommandHandler implements CommandHandler
{
    public function __construct(private RoleUpdater $roleUpdater)
    {
    }

    public function __invoke(UpdateRoleCommand $command): void
    {
        $id = RoleId::fromValue($command->id());
        $name = null === $command->name() ? null : RoleName::fromValue($command->name());

        $this->roleUpdater->__invoke($id, $name);
    }
}
