<?php

declare(strict_types=1);

namespace Apps\LumenApi\App\Http\Controllers\User;

use App\Application\User\Delete\DeleteUserCommand;
use App\Domain\Shared\Bus\Command\CommandBus;
use Apps\LumenApi\App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class DeleteUserController extends Controller
{
    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(Request $request, string $id): JsonResponse
    {
        $this->commandBus->dispatch(
            new DeleteUserCommand(
                $id
            )
        );

        return new JsonResponse(
            null,
            Response::HTTP_NO_CONTENT
        );
    }
}
