<?php

declare(strict_types=1);

namespace App\Application\Role\Update;

use App\Domain\Shared\Bus\Command\CommandHandler;
use App\Domain\Role\RoleEmail;
use App\Domain\Role\RoleId;
use App\Domain\Role\RolePassword;

final class UpdateRoleCommandHandler implements CommandHandler
{
    public function __construct(private RoleUpdater $roleUpdater)
    {
    }

    public function __invoke(UpdateRoleCommand $command): void
    {
        $id = RoleId::fromValue($command->id());
        $email = null === $command->email() ? null : RoleEmail::fromValue($command->email());
        $password = null === $command->password() ? null : RolePassword::fromValue($command->password());

        $this->roleUpdater->__invoke($id, $email, $password);
    }
}
