<?php

declare(strict_types=1);

namespace App\User\Application;

use App\Shared\Domain\Bus\Query\Response;
use App\User\Domain\User;

/**
 * @OA\Schema(@OA\Xml(name="UserResponse"))
 */
final class UserResponse implements Response
{
    /**
     * @OA\Property()
     * @var string
     */
    private string $id;

    /**
     * @OA\Property()
     * @var string
     */
    private string $email;

    public function __construct(
        string $id,
        string $email
    ) {
        $this->id = $id;
        $this->email = $email;
    }

    public static function fromUser(User $user): self
    {
        return new self(
            $user->id()->value(),
            $user->email()->value()
        );
    }

    public function id(): string
    {
        return $this->id;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email
        ];
    }
}
