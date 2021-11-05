<?php

declare(strict_types=1);

namespace App\Role\Application\Get;

use App\Role\Application\RoleResponse;
use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Role\Domain\RoleId;

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
