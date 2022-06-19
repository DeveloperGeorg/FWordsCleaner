output:
	composer install --optimize-autoloader --no-scripts && composer clear-cache

test:
	php vendor/bin/phpunit tests/