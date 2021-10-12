<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Domain\User\UserRepositoryInterface;
use Illuminate\Database\Seeder;
use Tests\Domain\User\UserEmailMother;
use Tests\Domain\User\UserIdMother;
use Tests\Domain\User\UserMother;

class DatabaseSeeder extends Seeder
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    public function run()
    {
        $user = UserMother::create(
            UserIdMother::create('9cfa2bef-13d4-4d4f-a6e0-a6fb6e4bdcfe'),
            UserEmailMother::create('develop.marcguinea@gmail.com')
        );

        $this->repository->save($user);
    }
}
