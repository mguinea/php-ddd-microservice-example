<?php

declare(strict_types=1);

namespace App\Application\Role\Get;

use App\Application\Role\RoleResponse;
use App\Domain\Shared\Bus\Query\QueryHandler;
use App\Domain\Role\RoleId;

final class GetRoleByIdQueryHandler implements QueryHandler
{
    public function __construct(private RoleGetterById $roleGetterById)
    {
    }

    public function __invoke(GetRoleByIdQuery $query): RoleResponse
    {
        $id = RoleId::fromValue($query->id());
        $role = $this->roleGetterById->__invoke($id);

        return RoleResponse::fromRole($role);
    }
}
