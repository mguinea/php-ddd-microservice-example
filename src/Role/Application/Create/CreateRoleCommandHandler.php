<?php

declare(strict_types=1);

namespace App\Role\Application\Create;

use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Role\Domain\RoleId;
use App\Role\Domain\RoleName;

final class CreateRoleCommandHandler implements CommandHandler
{
    public function __construct(private RoleCreator $roleCreator)
    {
    }

    public function __invoke(CreateRoleCommand $command): void
    {
        $id = RoleId::fromValue($command->id());
        $name = RoleName::fromValue($command->name());

        $this->roleCreator->__invoke($id, $name);
    }
}
