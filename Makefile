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

.PHONY: docker-test-php-71
docker-test-php-71: ## Docker test on PHP 7.1
	docker build -t php-test-env:7.1 tests/env/PHP_7.1 && \
	docker run -it -v "${PWD}":/usr/src/coinbase-php-sdk -w /usr/src/coinbase-php-sdk php-test-env:7.1 composer update -vvv && make phpstan && make tests

.PHONY: docker-test-php-72
docker-test-php-72: ## Docker test on PHP 7.2
	docker build -t php-test-env:7.2 tests/env/PHP_7.2 && \
	docker run -it -v "${PWD}":/usr/src/coinbase-php-sdk -w /usr/src/coinbase-php-sdk php-test-env:7.2 composer update -vvv && make phpstan && make tests

.PHONY: docker-test-php-73
docker-test-php-73: ## Docker test on PHP 7.3
	docker build -t php-test-env:7.3 tests/env/PHP_7.3 && \
	docker run -it -v "${PWD}":/usr/src/coinbase-php-sdk -w /usr/src/coinbase-php-sdk php-test-env:7.3 composer update -vvv && make phpstan && make tests

.PHONY: docker-test-php-74
docker-test-php-74: ## Docker test on PHP 7.4
	docker build -t php-test-env:7.4 tests/env/PHP_7.4 && \
	docker run -it -v "${PWD}":/usr/src/coinbase-php-sdk -w /usr/src/coinbase-php-sdk php-test-env:7.4 composer update -vvv && make phpstan && make tests

.PHONY: tests-in-all-php-versions
tests-in-all-php-versions: docker-test-php-71 docker-test-php-72 docker-test-php-73 docker-test-php-74 ## Run tests in all PHP versions through containers

.PHONY: help
help: ## Display this help message
	@grep -E '^[a-zA-Z0-9_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'
