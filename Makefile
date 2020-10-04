.PHONY: chained-tests
chained-tests: phpstan phpcs-dry-run tests-unit ## Run phpstan, phpcs and PHPUnit tests 'Unit' suite

.PHONY: tests-unit-and-functional
tests-unit-and-functional: ## Launch PHPUnit tests 'Unit' and 'Functional' suites
	rm -Rf .coverage && vendor/bin/phpunit --colors=always --testdox

.PHONY: tests-unit-and-functional-with-coverage
tests-unit-and-functional-with-coverage: ## Launch PHPUnit tests 'Unit' and 'Functional' suites
	rm -Rf .coverage && vendor/bin/phpunit --colors=always --coverage-html .coverage

.PHONY: tests-unit
tests-unit: ## Launch PHPUnit tests 'Unit' suite
	rm -Rf .coverage && vendor/bin/phpunit --colors=always --testdox --testsuite Unit

.PHONY: tests-unit-with-coverage
tests-unit-with-coverage: ## Launch PHPUnit tests 'Unit' suite with coverage
	rm -Rf .coverage && vendor/bin/phpunit --colors=always --testdox --coverage-html .coverage --testsuite Unit

.PHONY: tests-functional
tests-functional: ## Launch PHPUnit tests 'Functional' suite
	vendor/bin/phpunit --colors=always --testdox --coverage-html .coverage --testsuite Functional

.PHONY: phpcs
phpcs: ## Apply PHP CS fixes
	vendor/bin/php-cs-fixer fix

.PHONY: phpcs-dry-run
phpcs-dry-run: ## Coding style checks
	vendor/bin/php-cs-fixer fix --dry-run

.PHONY: phpstan
phpstan: ## Static analysis
	vendor/bin/phpstan analyse --level=7 src

.PHONY: docker-test-php-71
docker-test-php-71: ## Docker test on PHP 7.1
	docker build -t php-test-env:7.1 tests/env/PHP_7.1
	docker run -it -v "${PWD}":/usr/src/coinbase-php-sdk -v $(shell composer config --global cache-dir):/.composer \
	-w /usr/src/coinbase-php-sdk \
	--user $(shell id -u):$(shell id -g) \
	php-test-env:7.1 \
	/bin/bash -c "composer update -no --no-progress --no-suggest && make phpstan && make tests-unit"

.PHONY: docker-test-php-72
docker-test-php-72: ## Docker test on PHP 7.2
	docker build -t php-test-env:7.2 tests/env/PHP_7.2
	docker run -it -v "${PWD}":/usr/src/coinbase-php-sdk -v $(shell composer config --global cache-dir):/.composer \
	-w /usr/src/coinbase-php-sdk \
	--user $(shell id -u):$(shell id -g) \
	php-test-env:7.2 \
	/bin/bash -c "composer update -no --no-progress --no-suggest && make phpstan && make tests-unit"

.PHONY: docker-test-php-73
docker-test-php-73: ## Docker test on PHP 7.3
	docker build -t php-test-env:7.3 tests/env/PHP_7.3
	docker run -it -v "${PWD}":/usr/src/coinbase-php-sdk -v $(shell composer config --global cache-dir):/.composer \
	-w /usr/src/coinbase-php-sdk \
	--user $(shell id -u):$(shell id -g) \
	php-test-env:7.3 \
	/bin/bash -c "composer update -no --no-progress --no-suggest && make phpstan && make tests-unit"

.PHONY: docker-test-php-74
docker-test-php-74: ## Docker test on PHP 7.4
	docker build -t php-test-env:7.4 tests/env/PHP_7.4
	docker run -it -v "${PWD}":/usr/src/coinbase-php-sdk -v $(shell composer config --global cache-dir):/.composer \
	-w /usr/src/coinbase-php-sdk \
	--user $(shell id -u):$(shell id -g) \
	php-test-env:7.4 \
	/bin/bash -c "composer update -no --no-progress --no-suggest && make phpstan && make tests-unit"

.PHONY: tests-unit-in-all-php-versions
tests-in-all-php-versions: docker-test-php-71 docker-test-php-72 docker-test-php-73 docker-test-php-74 ## Run tests 'Unit' in all PHP versions through containers

.PHONY: help
help: ## Display this help message
	@grep -E '^[a-zA-Z0-9_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'
