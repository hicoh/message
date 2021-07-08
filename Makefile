phpcs:
	php vendor/bin/php-cs-fixer --config=./.php-cs-fixer.php fix -v --dry-run --stop-on-violation src
csfix:
	php vendor/bin/php-cs-fixer --config=./.php-cs-fixer.php fix -v --stop-on-violation src
runtests:
	php vendor/bin/phpunit