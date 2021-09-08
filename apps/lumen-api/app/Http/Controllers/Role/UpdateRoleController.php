<?php

declare(strict_types=1);

namespace Apps\LumenApi\App\Http\Controllers\Role;

use App\Application\Role\Get\GetRoleByIdQuery;
use App\Application\Role\Update\UpdateRoleCommand;
use App\Application\Role\RoleResponse;
use App\Domain\Shared\Bus\Command\CommandBus;
use App\Domain\Shared\Bus\Query\QueryBus;
use App\Domain\Shared\RequestValidator;
use Apps\LumenApi\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class UpdateRoleController extends Controller
{
    public function __construct(
        private CommandBus $commandBus,
        private QueryBus $queryBus,
        private RequestValidator $validator
    ) {
    }

    public function __invoke(Request $request, string $id): JsonResponse
    {
        $this->validator->validate(
            $request,
            [
                'email' => 'email'
            ]
        );

        $email = $request->get('email');
        $password = $request->get('password');

        $this->commandBus->dispatch(
            new UpdateRoleCommand(
                $id,
                $email,
                $password
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
