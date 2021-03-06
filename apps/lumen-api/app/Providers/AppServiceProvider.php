<?php

namespace Apps\LumenApi\App\Providers;

use App\Domain\Shared\Bus\Command\CommandBus as CommandBusInterface;
use App\Domain\Shared\Bus\Event\EventBus as EventBusInterface;
use App\Domain\Shared\Bus\Query\QueryBus as QueryBusInterface;
use App\Domain\Shared\RequestValidator;
use App\Domain\Shared\UuidGenerator;
use App\Infrastructure\Shared\Bus\Messenger\MessengerCommandBus;
use App\Infrastructure\Shared\Bus\Messenger\MessengerEventBus;
use App\Infrastructure\Shared\Bus\Messenger\MessengerQueryBus;
use App\Infrastructure\Shared\LumenRequestValidator;
use App\Infrastructure\Shared\RamseyUuidGenerator;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application;

final class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    public function register()
    {
        $this->app->bind(
            EventBusInterface::class,
            function (Application $app) {
                return new MessengerEventBus($app->tagged('domain_event_subscriber'));
            }
        );

        $this->app->bind(
            QueryBusInterface::class,
            function (Application $app) {
                return new MessengerQueryBus($app->tagged('query_handler'));
            }
        );

        $this->app->bind(
            CommandBusInterface::class,
            function (Application $app) {
                return new MessengerCommandBus($app->tagged('command_handler'));
            }
        );

        $this->app->bind(
            UuidGenerator::class,
            RamseyUuidGenerator::class
        );

        $this->app->bind(
            RequestValidator::class,
            LumenRequestValidator::class
        );
    }
}
