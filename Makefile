up:
	@docker-compose up -d

stop:
	@docker-compose stop

tail:
	@docker-compose logs -f

php:
	@docker-compose exec php-cli bash

.PHONY: up stop tail php
