.PHONY: test-all-kinds
test-all-kinds: tests-no-useless phpcs-dry-run phpstan ## Run tests suite of all kinds

.PHONY: tests-with-coverge
tests-with-coverage: ## Launch PHPUnit test suite with coverage
	rm -Rf .coverage && vendor/bin/phpunit --colors=always --testdox --dont-report-useless-tests --coverage-html .coverage

.PHONY: tests-no-useless
tests-no-useless: ## Launch PHPUnit test suite
	vendor/bin/phpunit --colors=always --testdox --dont-report-useless-tests

.PHONY: tests
tests: ## Launch PHPUnit test suite
	vendor/bin/phpunit --colors=always --testdox

.PHONY: phpcs
phpcs: ## Apply PHP CS fixes
	vendor/bin/php-cs-fixer fix

.PHONY: phpcs-dry-run
phpcs-dry-run: ## Coding style checks
	vendor/bin/php-cs-fixer fix --dry-run

.PHONY: phpstan
phpstan: ## Static analysis
	vendor/bin/phpstan analyse --level=3 src

project_path := $(abspath $(lastword $(MAKEFILE_LIST)))

.PHONY: docker-test
docker-test:## Docker testing env
	docker build -t php-test-env:7.1 tests/env/PHP_7.1 && docker run -it -v "${PWD}":/usr/src/coinbase-php-sdk -w /usr/src/coinbase-php-sdk php-test-env:7.1 composer update -vvv && make tests

.PHONY: help
help: ## Display this help message
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'
