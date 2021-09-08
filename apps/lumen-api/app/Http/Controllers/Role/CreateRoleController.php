<?php

declare(strict_types=1);

namespace Apps\LumenApi\App\Http\Controllers\Role;

use App\Application\Role\Create\CreateRoleCommand;
use App\Application\Role\Get\GetRoleByIdQuery;
use App\Application\Role\RoleResponse;
use App\Domain\Shared\Bus\Command\CommandBus;
use App\Domain\Shared\Bus\Query\QueryBus;
use App\Domain\Shared\RequestValidator;
use App\Domain\Shared\UuidGenerator;
use Apps\LumenApi\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class CreateRoleController extends Controller
{
    public function __construct(
        private CommandBus $commandBus,
        private QueryBus $queryBus,
        private UuidGenerator $generator,
        private RequestValidator $validator
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $this->validator->validate(
            $request,
            [
                'name' => 'required|string|unique:mysql.roles,name'
            ]
        );

        $id = $request->get('id', $this->generator->generate());
        $name = $request->get('name');

        $this->commandBus->dispatch(
            new CreateRoleCommand(
                $id,
                $name
            )
        );

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
