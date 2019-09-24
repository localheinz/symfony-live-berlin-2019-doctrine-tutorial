.PHONY: cs help it layer run test

it: cs layer test  ## Runs the test target

cs: vendor ## Fixes code style issues with php-cs-fixer
	mkdir -p .build/php-cs-fixer
	vendor/bin/php-cs-fixer fix --config=.php_cs --diff --diff-format=udiff --verbose

help: ## Displays this list of targets with descriptions
	@grep -E '^[a-zA-Z0-9_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}'

layer: vendor ## Runs a dependency analysis with deptrac
	mkdir -p .build/deptrac
	vendor/bin/deptrac analyze depfile.yml --cache-file=.build/deptrac/deptrac.cache

run: vendor ## Serves the application
	php -S localhost:8080 -t public

test: vendor ## Runs unit and integration tests with phpunit, as well as specifications with behat
	mkdir -p .build/phpunit
	vendor/bin/phpunit --configuration=test/Unit/phpunit.xml
	vendor/bin/phpunit --configuration=test/Integration/phpunit.xml
	vendor/bin/behat

vendor: composer.json composer.lock ## Installs dependencies with composer
	composer validate --strict
	composer normalize
	composer install --no-interaction --no-progress --no-suggest
