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
	@docker exec -it php-ddd-microservice-example.lumen-api composer install

composer-update:
	@docker exec -it php-ddd-microservice-example.lumen-api composer update

composer-dump-autoload:
	@docker exec -it php-ddd-microservice-example.lumen-api composer dump-autoload

migrate:
	@docker exec -it -w /var/www/apps/lumen-api php-ddd-microservice-example.lumen-api php artisan migrate

migrate-fresh:
	@docker exec -it -w /var/www/apps/lumen-api php-ddd-microservice-example.lumen-api php artisan migrate:fresh

bash-lumen:
	@docker exec -it -w /var/www/apps/lumen-api php-ddd-microservice-example.lumen-api bash

bash-db:
	@docker exec -it -w / php-ddd-microservice-example.db bash

# @docker exec -it php-ddd-microservice-example.lumen-api vendor/bin/phpunit apps/lumen-api/tests --order-by=random --configuration=apps/lumen-api/phpunit.xml

.PHONY: tests
tests:
	@docker exec -it php-ddd-microservice-example.unit-tests vendor/bin/phpunit ./tests --order-by=random --configuration=./phpunit.xml
