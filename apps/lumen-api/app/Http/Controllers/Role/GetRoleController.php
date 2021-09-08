<?php

declare(strict_types=1);

namespace Apps\LumenApi\App\Http\Controllers\Role;

use App\Application\Role\Get\GetRoleByIdQuery;
use App\Application\Role\RoleResponse;
use App\Domain\Shared\Bus\Query\QueryBus;
use Apps\LumenApi\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class GetRoleController extends Controller
{
    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(Request $request, string $id): JsonResponse
    {
        /** @var RoleResponse $roleResponse */
        $roleResponse = $this->queryBus->ask(
            new GetRoleByIdQuery(
                $id
            )
        );

        return new JsonResponse(
            $roleResponse->toArray(),
            Response::HTTP_OK
        );
    }
}
