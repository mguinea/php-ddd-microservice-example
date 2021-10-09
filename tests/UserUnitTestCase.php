<?php

namespace Tests;

use App\Domain\User\User;
use App\Domain\User\UserId;
use App\Domain\User\UserRepositoryInterface;
use Prophecy\Prophecy\ObjectProphecy;
use Tests\Infrastructure\PhpUnit\UnitTestCase;

abstract class UserUnitTestCase extends UnitTestCase
{
    private object $repository;
    private ObjectProphecy $repositoryProphecy;

    protected function shouldSave(User $user): void
    {
        $this->repositoryProphecy()->save($user);
    }

    protected function shouldFind(UserId $id, User $user): void
    {
        $this->repositoryProphecy()->findById($id)->willReturn($user);
    }

    protected function shouldNotFind(UserId $id): void
    {
        $this->repositoryProphecy()->findById($id)->willReturn(null);
    }

    /**
     * @return object|UserRepositoryInterface
     */
    protected function repository(): UserRepositoryInterface
    {
        return $this->repository = $this->repository ?? $this->repositoryProphecy()->reveal();
    }

    private function repositoryProphecy(): ObjectProphecy
    {
        return $this->repositoryProphecy = $this->repositoryProphecy ?? $this->prophecy(UserRepositoryInterface::class);
    }
}
