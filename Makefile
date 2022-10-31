
composer:
	docker-compose run --rm php bash -c "composer install --no-scripts --no-plugins"

composerupdate:
	docker-compose run --rm php bash -c "composer update --no-scripts"