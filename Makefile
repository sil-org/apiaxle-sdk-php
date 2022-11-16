
composer:
	docker-compose run --rm php bash -c "composer install --no-scripts --no-plugins"

composerupdate:
	docker-compose run --rm php bash -c "composer update --no-scripts"

test:
	docker-compose run --rm php bash -c "./vendor/bin/phpunit ./tests"

testenv:
	@echo "\n\n./vendor/bin/phpunit ./tests/KeyTest.php --filter testMyStuff\n\n"
	docker-compose run --rm php bash