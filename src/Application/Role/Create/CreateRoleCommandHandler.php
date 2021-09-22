<?php

declare(strict_types=1);

namespace App\Application\Role\Create;

use App\Domain\Shared\Bus\Command\CommandHandler;
use App\Domain\Role\RoleId;
use App\Domain\Role\RoleName;

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
