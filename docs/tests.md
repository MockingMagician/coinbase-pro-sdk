---
layout: default
title: Tests
nav_order: 4
---

# Tests

For any test execution the following environment variables must be available:
* API_KEY=my-api-key
* API_SECRET=my-secret
* API_PASSPHRASE=my-passphrase

***For security reasons, API_ENDPOINT has been hard-coded at the test level on the url https://api-public.sandbox.pro.coinbase.com.***

The only recommended way to provide these variables in the test set is to provide the root of the project with an .env file containing these variables.

.env file example :

```dotenv
API_KEY=my-api-key
API_SECRET=my-secret
API_PASSPHRASE=my-passphrase
```

The vast majority of the test set is composed of functional call and response tests of the API.

In order for these tests to pass, your test account on Coinbase Pro must be funded with cash.

***The currency in the test account is not real money. You can deposit it without limit using the deposit functions provided on the interface.***

It is intended that the set of tests will fund your account from virtual Coinbase accounts. At the first use, it is possible that the tests may not pass if the funds are insufficient, restart the tests.

## Running tests methods

A Makefile is present in the project and provides shortcuts to run the tests. Run the ***make help*** command for the complete list of shortcuts :

```bash
chained-tests                               Run phpstan, phpcs and PHPUnit tests 'Unit' suite
docker-test-php-71                          Docker test on PHP 7.1
docker-test-php-72                          Docker test on PHP 7.2
docker-test-php-73                          Docker test on PHP 7.3
docker-test-php-74                          Docker test on PHP 7.4
docker-test-php-80                          Docker test on PHP 8.0
help                                        Display this help message
phpcs                                       Apply PHP CS fixes
phpcs-dry-run                               Coding style checks
phpstan                                     Static analysis
tests-functional                            Launch PHPUnit tests 'Functional' suite
tests-in-all-php-versions                   Run tests 'Unit' in all PHP versions through containers
tests-unit-and-functional                   Launch PHPUnit tests 'Unit' and 'Functional' suites
tests-unit-and-functional-with-coverage     Launch PHPUnit tests 'Unit' and 'Functional' suites
tests-unit                                  Launch PHPUnit tests 'Unit' suite
tests-unit-with-coverage                    Launch PHPUnit tests 'Unit' suite with coverage

```
