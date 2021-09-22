<?php

namespace Tests\Application\User\Create;

use App\Application\User\Create\CreateUserCommandHandler;
use App\Application\User\Create\UserCreator;
use Tests\Domain\User\UserMother;
use Tests\UserUnitTestCase;

final class CreateUserCommandHandlerTest extends UserUnitTestCase
{
    private CreateUserCommandHandler $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new CreateUserCommandHandler(
            new UserCreator(
                $this->repository(),
                $this->eventBus()
            )
        );
    }

    /** @test */
    public function itShouldCreateAUser(): void
    {
        $user = UserMother::create();
        $command = CreateUserCommandMother::create(
            $user->id(),
            $user->email(),
            $user->password()
        );
        $this->shouldSave($user);

        $this->dispatch($command, $this->handler);
    }
}
