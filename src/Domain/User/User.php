<?php

declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\Shared\AbstractAggregateRoot;

final class User extends AbstractAggregateRoot
{
    public function __construct(
        private UserId $id,
        private UserEmail $email,
        private UserPassword $password
    )
    {
    }

    public static function create(UserId $id, UserEmail $email, UserPassword $password): self
    {
        $user = new self(
            $id,
            $email,
            $password
        );

        $user->record(UserWasCreated::fromPrimitives(
            $id->value(),
            [
                'email' => $email->value()
            ]
        ));

        return $user;
    }

    public function update(?UserEmail $email = null, ?UserPassword $password = null): void
    {
        $this->email = null === $email ? $this->email : $email;
        $this->password = null === $password ? $this->password : $password;

        $this->record(UserWasUpdated::fromPrimitives(
            $this->id()->value(),
            [
                'email' => $this->email()->value()
            ]
        ));
    }

    public static function fromPrimitives(string $id, string $email, string $password): self
    {
        return new self(
            UserId::fromValue($id),
            UserEmail::fromValue($email),
            UserPassword::fromValue($password)
        );
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function email(): UserEmail
    {
        return $this->email;
    }

    public function password(): UserPassword
    {
        return $this->password;
    }
}
