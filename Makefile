up:
	cd docker && docker compose up -d
stop:
	cd docker && docker compose stop
execute:
	php index.php -s=6 -a=3
sniff:
	php ./vendor/bin/phpcs --standard=PSR12 ./src ./tests
stan:
	php ./vendor/bin/phpstan analyse ./src ./tests --level=9
test:
	php ./vendor/bin/phpunit --testdox
