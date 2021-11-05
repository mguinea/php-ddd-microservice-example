<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Persistence\Pdo;

use App\Shared\Domain\Criteria\Criteria;
use App\User\Domain\User;
use App\User\Domain\UserId;
use App\User\Domain\UserRepositoryInterface;
use PDO;
use PDOException;

final class MySqlUserRepository implements UserRepositoryInterface
{
    private PDO $connection;

    public function __construct(
        string $servername,
        string $username,
        string $password,
        string $dbname
    )
    {
        $this->connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function deleteById(UserId $id): void
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM users WHERE id = :id");
            $stmt->bindValue(':id', $id->value());
            $stmt->execute();
        } catch (PDOException $e) {
            throw new MySqlUserRepositoryException($e->getMessage(), $e->getCode(), $e->getTrace());
        }
    }

    public function findById(UserId $id): ?User
    {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE id=:id");
        $stmt->execute(['id' => $id->value()]);
        $user = $stmt->fetch(PDO::FETCH_OBJ);

        if (false === $user) {
            return null;
        }

        return User::fromPrimitives(
            $user->id,
            $user->name,
            $user->password
        );
    }

    public function save(User $user): void
    {
        try {
            $userFromDb = $this->findById($user->id());

            if (null === $userFromDb) {
                $sql = "INSERT INTO users VALUES(:id, :name)";
            } else {
                $sql = "UPDATE users SET name=:name, damage=:damage WHERE id = :id";
            }

            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(':id', $user->id()->value());
            $stmt->bindValue(':name', $user->name()->value());
            $stmt->execute();
        } catch (PDOException $e) {
            throw new MySqlUserRepositoryException($e->getMessage(), $e->getCode(), $e->getTrace());
        }
    }

    public function searchByCriteria(Criteria $criteria): array
    {
        // TODO: Implement searchByCriteria() method.
    }
}
