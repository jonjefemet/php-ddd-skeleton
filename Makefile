install:
	docker-compose run --rm backoffice_service composer install

up:
	docker-compose up -d

down:
	docker-compose down

build:
	docker-compose build

logs:
	docker-compose logs -f

restart:
	docker-compose restart

test:
	docker-compose run --rm backoffice_service vendor/bin/phpunit

add-dependency:
	docker-compose run --rm backoffice_service composer require $(dependency)
	docker-compose run --rm backoffice_service composer dump-autoload

dump-autoload:
	docker-compose run --rm backoffice_service composer dump-autoload
