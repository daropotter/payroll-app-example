start: run-db serve
run-db:
	docker-compose -f docker-compose.yml -f docker-compose.override.yml up -d
stop-db:
	docker-compose -f docker-compose.yml -f docker-compose.override.yml down

test: phpcs psalm deptrac phpunit behat
phpcs:
	php vendor/bin/phpcs
psalm:
	php vendor/bin/psalm
deptrac:
	php vendor/bin/deptrac --config-file config/deptrac/layers.yaml
	php vendor/bin/deptrac --config-file config/deptrac/modules.yaml
phpunit:
	php vendor/bin/phpunit
behat:
	php vendor/bin/behat
