.PHONY: help it run

it: vendor ## Runs the vendor target

run: vendor ## Serves the application
	php -S localhost:8080 -t public

help: ## Displays this list of targets with descriptions
	@grep -E '^[a-zA-Z0-9_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}'

vendor: composer.json composer.lock ## Installs dependencies with composer
	composer validate --strict
	composer normalize
	composer install --no-interaction --no-progress --no-suggest
