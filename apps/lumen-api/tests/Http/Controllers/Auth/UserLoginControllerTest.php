<?php

declare(strict_types=1);

namespace Apps\LumenApi\Tests\Http\Controllers\Auth;

use App\Domain\User\User;
use Apps\LumenApi\Tests\TestCase;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\Domain\User\UserMother;
use Tests\Domain\User\UserPasswordMother;

final class UserLoginControllerTest extends TestCase
{
    use DatabaseTransactions;

    private string $endpoint = '/auth/api/users/login';

    public function testLogInRegisteredUser(): void
    {
        $user = UserMother::create();
        $this->registerUser($user);

        $payload = [
            'email' => $user->email()->value(),
            'password' => $user->password()->value()
        ];

        $this->post($this->endpoint, $payload);

        $this->response
            ->assertJson(
                [
                    'email' => $user->email()->value()
                ]
            )
            ->assertStatus(Response::HTTP_OK);
    }

    private function registerUser(User $user): void
    {
        $payload = [
            'email' => $user->email()->value(),
            'password' => $user->password()->value()
        ];

        $this->post('/auth/api/users', $payload);
    }

    public function testLogInNonRegisteredUser(): void
    {
        $user = UserMother::create();
        $this->registerUser($user);

        $payload = [
            'email' => $user->email()->value(),
            'password' => UserPasswordMother::create()->value()
        ];

        $this->post($this->endpoint, $payload);

        $this->response
            ->assertJson(
                [
                    'errors' => "Authentication error"
                ]
            )
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
