PROJECT_NAME := php-ddd-microservice-example
DOCKER_COMPOSE = docker-compose -p $(PROJECT_NAME) -f docker-compose.yml

install:
	@docker network inspect php-ddd-microservice-example > /dev/null || docker network create php-ddd-microservice-example
	@make build
	@make up
	@make composer-install

build:
	$(DOCKER_COMPOSE) build

up:
	$(DOCKER_COMPOSE) up -d --force-recreate --remove-orphans

destroy:
	$(DOCKER_COMPOSE) down
	$(DOCKER_COMPOSE) rm -f
	@docker volume rm php-ddd-microservice-example_php-ddd-microservice-example-dbdata

services:
	$(DOCKER_COMPOSE) ps

networks:
	@docker network ls

volumes:
	@docker volume ls

composer-install:
	@docker exec -it php-ddd-microservice-example.app composer install

composer-update:
	@docker exec -it php-ddd-microservice-example.app composer update

composer-dump-autoload:
	@docker exec -it php-ddd-microservice-example.app composer dump-autoload

migrate:
	@docker exec -it -w /var/www/apps/auth-api php-ddd-microservice-example.app php artisan migrate

migrate-fresh:
	@docker exec -it -w /var/www/apps/auth-api php-ddd-microservice-example.app php artisan migrate:fresh

bash-app:
	@docker exec -it -w /var/www/apps/auth-api php-ddd-microservice-example.app bash

bash-db:
	@docker exec -it -w / php-ddd-microservice-example.db bash

.PHONY: tests
tests:
	@docker exec -it php-ddd-microservice-example.app vendor/bin/phpunit apps/auth-api/tests --order-by=random --configuration=apps/auth-api/phpunit.xml
