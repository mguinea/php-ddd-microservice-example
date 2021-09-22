<?php

namespace Tests\Infrastructure\PhpUnit;

use App\Domain\Shared\Bus\Command\Command;
use App\Domain\Shared\Bus\Command\CommandBus;
use App\Domain\Shared\Bus\Event\DomainEvent;
use App\Domain\Shared\Bus\Event\EventBus;
use App\Domain\Shared\Bus\Query\Query;
use App\Domain\Shared\Bus\Query\QueryBus;
use App\Domain\Shared\Bus\Query\Response;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophet;

abstract class UnitTestCase extends TestCase
{
    protected Prophet $prophet;

    private ObjectProphecy $queryBusProphecy;
    private QueryBus $queryBus;
    private ObjectProphecy $commandBusProphecy;
    private CommandBus $commandBus;
    private ObjectProphecy $eventBusProphecy;
    private EventBus $eventBus;

    protected function setUp(): void
    {
        $this->prophet = new Prophet();
    }

    protected function tearDown(): void
    {
        $this->prophet->checkPredictions();
    }

    protected function prophecy(string $interface): ObjectProphecy
    {
        return $this->prophet->prophesize($interface);
    }

    protected function notify(DomainEvent $event, callable $subscriber): void
    {
        $subscriber($event);
    }

    protected function dispatch(Command $command, callable $commandHandler): void
    {
        $commandHandler($command);
    }

    protected function assertDispatchThrowsException(string $expectedException, Command $command, callable $commandHandler): void
    {
        $this->expectException($expectedException);

        $commandHandler($command);
    }

    protected function assertAskResponse(Response $expected, Query $query, callable $queryHandler): void
    {
        $actual = $queryHandler($query);

        $this->assertEquals($expected, $actual);
    }

    protected function assertAskThrowsException(string $expectedErrorClass, Query $query, callable $queryHandler): void
    {
        $this->expectException($expectedErrorClass);

        $queryHandler($query);
    }

    protected function assertAskNullResponse(Query $query, callable $queryHandler): void
    {
        $actual = $queryHandler($query);

        $this->assertNull($actual);
    }

    protected function shouldPublishDomainEvent(DomainEvent $domainEvent): void
    {
        $this->eventBusProphecy()
            ->publish($domainEvent)
            ->shouldBeCalledOnce();
    }

    /**
     * @return object|QueryBus
     */
    protected function queryBus()
    {
        return $this->queryBus = $this->queryBus ?? $this->queryBusProphecy()->reveal();
    }

    protected function queryBusProphecy(): ObjectProphecy
    {
        return $this->queryBusProphecy = $this->queryBusProphecy ?? $this->prophecy(QueryBus::class);
    }

    /**
     * @return object|CommandBus
     */
    protected function commandBus()
    {
        return $this->commandBus = $this->commandBus ?? $this->commandBusProphecy()->reveal();
    }

    protected function commandBusProphecy(): ObjectProphecy
    {
        return $this->commandBusProphecy = $this->commandBusProphecy ?? $this->prophecy(CommandBus::class);
    }

    /**
     * @return object|EventBus
     */
    protected function eventBus()
    {
        return $this->eventBus = $this->eventBus ?? $this->eventBusProphecy()->reveal();
    }

    protected function eventBusProphecy(): ObjectProphecy
    {
        return $this->eventBusProphecy = $this->eventBusProphecy ?? $this->prophecy(EventBus::class);
    }
}
