<?php

declare(strict_types=1);

namespace Apps\LumenApi\App\Providers;

use App\Application\User\Create\CreateUserCommandHandler;
use App\Application\User\Delete\DeleteUserCommandHandler;
use App\Application\User\Get\GetUserByIdQueryHandler;
use App\Application\User\Update\UpdateUserCommandHandler;
use App\Domain\User\UserRepositoryInterface;
use App\Infrastructure\User\Persistence\Eloquent\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

final class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            EloquentUserRepository::class
        );

        $this->app->tag(
            [
                CreateUserCommandHandler::class,
                DeleteUserCommandHandler::class,
                UpdateUserCommandHandler::class,
            ],
            'command_handler'
        );

        $this->app->tag(
            GetUserByIdQueryHandler::class,
            'query_handler'
        );
    }
}
