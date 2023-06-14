
composer:
	docker-compose run --rm php bash -c "composer install --no-scripts --no-plugins"

composershow:
	docker-compose run --rm php bash -c 'composer show --format=json --no-dev --no-ansi --locked | jq ".locked[] | { \"name\": .name, \"version\": .version }" > dependencies.json'

composerupdate:
	docker-compose run --rm php bash -c "composer update --no-scripts"
	make composershow

test:
	docker-compose run --rm php bash -c "./vendor/bin/phpunit ./tests"

testenv:
	@echo "\n\n./vendor/bin/phpunit ./tests/KeyTest.php --filter testMyStuff\n\n"
	docker-compose run --rm php bash