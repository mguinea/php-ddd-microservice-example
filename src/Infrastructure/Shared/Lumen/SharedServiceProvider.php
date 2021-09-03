<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Lumen;

use App\Domain\Shared\Bus\Command\CommandBus as CommandBusInterface;
use App\Domain\Shared\Bus\Event\EventBus as EventBusInterface;
use App\Domain\Shared\Bus\Query\QueryBus as QueryBusInterface;
use App\Domain\Shared\RequestValidator;
use App\Domain\Shared\UuidGenerator;
use App\Infrastructure\Shared\Bus\Messenger\MessengerEventBus;
use App\Infrastructure\Shared\Lumen\LumenRequestValidator;
use App\Infrastructure\Shared\RamseyUuidGenerator;
use App\Infrastructure\Shared\Bus\Messenger\MessengerCommandBus;
use App\Infrastructure\Shared\Bus\Messenger\MessengerQueryBus;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application;

final class SharedServiceProvider extends ServiceProvider
{
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
