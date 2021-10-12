<h1 align="center">
  PHP Microservice example using DDD, Hexagonal and best practices
</h1>

<p align="center">
    <a href="https://lumen.laravel.com/"><img src="https://img.shields.io/badge/Lumen-8-FF2D20.svg?style=flat-square&logo=lumen" alt="Lumen 8"/></a>
    <a href="https://symfony.com/"><img src="https://img.shields.io/badge/Symfony-5-000000.svg?style=flat-square&logo=symfony" alt="Symfony 5"/></a>
    <a href="https://www.php.net/"><img src="https://img.shields.io/badge/PHP-8-777BB4.svg?style=flat-square&logo=php" alt="PHP"/></a>
    <a href="https://www.jetbrains.com/es-es/phpstorm/?ref=steemhunt"><img src="https://img.shields.io/badge/PhpStorm-2021-000000.svg?style=flat-square&logo=phpstorm" alt="PhpStorm"/></a>
    <a href="https://www.docker.com/"><img src="https://img.shields.io/badge/docker-3-2496ED.svg?style=flat-square&logo=docker" alt="Docker"/></a>
    <a href="https://www.mysql.com/"><img src="https://img.shields.io/badge/mysql-5.7-4479A1.svg?style=flat-square&logo=mysql" alt="MySql"/></a>
    <a href="https://www.sqlite.org/index.html"><img src="https://img.shields.io/badge/sqlite-3-003B57.svg?style=flat-square&logo=sqlite" alt="SQLite"/></a>
    <a href="#"><img src="https://img.shields.io/badge/github_actions-2088FF.svg?style=flat-square&logo=github-actions" alt="Github Actions"/></a>
</p>

<p align="center">
  This is a repo containing a <strong>PHP application using Domain-Driven Design (DDD) and Command Query Responsibility Segregation
  (CQRS) principles</strong>.
  <br />
  <br />
  It's a basic implementation of a User - Role manager. There is a version implemented using Lumen framework and another one using Symfony framework.
  <br />
  Both shares the same <code>domain</code> logics implemented in the <code>src</code> folder.
  <br />
  <br />
  <a href="https://github.com/mguinea/php-ddd-microservice-example/issues">Report a bug</a>
  ·
  <a href="https://github.com/mguinea/php-ddd-microservice-example/issues">Request a feature</a>
</p>

<p align="center">
    <a href="https://github.com/mguinea/php-ddd-microservice-example/actions"><img src="https://github.com/mguinea/php-ddd-microservice-example/workflows/CI/badge.svg" alt="CI pipeline status" /></a>
</p>

## Installation

### Requirements
- [Install Docker](https://www.docker.com/get-started)

### Environment

- Clone this project: `git clone https://github.com/mguinea/php-ddd-microservice-example php-ddd-microservice-example`
- Move to the project folder: `cd php-ddd-microservice-example`
- Create a local environment file `cp .env.example .env`
- Change (if required) ports and any other environment variables in `.env` file

### Execution

Install all the dependencies and bring up the project with Docker executing: `make install`

Then you'll have 2 apps available (an api made using Lumen and the same one made using Symfony):
1. Lumen API: http://localhost:8180/lumen/api/v1/health-check
2. Symfony API: http://localhost:8180/symfony/api/v1/health-check

### Tests

Install the dependencies if you haven't done it previously: `make composer-install`

Execute all test suites: `make tests`

## Monitoring

TODO

## Project structure and explanation

### Bounded contexts

`src` folder contains the bounded context responsible for the management of users and roles and their relations.

### Architecture and Structure

This repository follows the Hexagonal Architecture pattern. Also, it's structured using modules. With this, we can see that the current structure of the Bounded Context is:

```scala
$ tree -L 2 src

src
├── Application
│   ├── Role
│   └── User
├── Domain
│   ├── Role
│   ├── Shared
│   └── User
└── Infrastructure
    ├── Role
    ├── Shared
    └── User
```

#### Repositories

##### Repository pattern

Our repositories try to be as simple as possible usually only containing basic CRUD methods (delete, find, save and search).
If we need some query with more filters we use the Specification pattern also known as Criteria pattern. So we add a `searchByCriteria` method.

##### Implementations

There is an implementation using `Eloquent` for `Lumen` and another one made by using `PDO` for `Symfony`

#### CQRS

We are using `symfony messenger` to implement buses for Lumen and Symfony implementations.

#### My conventions

There are some opinionated resolutions / approaches in this project.

##### Generic methods (CRUDs)

- `get` retrieve an entity. If not found, throws an exception.
- `find` retrieve an entity. If not found, return null.
- `delete` delete an entity. If not found, throws an exception.
- `create` create an entity. If found, throw an exception.
- `update` update an entity. If not found, throws an exception.
- `search` retrieve a collection of entities by criteria. If nothing found, returns an empty collection.
- `listing` retrieve a collection of entities with no criteria. If nothing found, returns an empty collection.
