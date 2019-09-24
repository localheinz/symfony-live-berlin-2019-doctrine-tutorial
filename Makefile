.PHONY: help it run test

it: test  ## Runs the test target

help: ## Displays this list of targets with descriptions
	@grep -E '^[a-zA-Z0-9_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}'

run: vendor ## Serves the application
	php -S localhost:8080 -t public

test: vendor ## Runs unit and integration tests with phpunit
	mkdir -p .build/phpunit
	vendor/bin/phpunit --configuration=test/Unit/phpunit.xml
	vendor/bin/phpunit --configuration=test/Integration/phpunit.xml

vendor: composer.json composer.lock ## Installs dependencies with composer
	composer validate --strict
	composer normalize
	composer install --no-interaction --no-progress --no-suggest
