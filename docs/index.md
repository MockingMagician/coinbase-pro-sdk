---
layout: default
title: Installation
nav_order: 0
---

![Coinbase LOGO](assets/images/coinbase-pro-sdk-min.png "Coinbase LOGO")

# This package is designed to communicate easily with the Coinbase Pro API in PHP.

![GitHub release (latest SemVer)](https://img.shields.io/github/v/release/MockingMagician/coinbase-pro-sdk) ![GitHub Workflow Status (branch)](https://img.shields.io/github/workflow/status/MockingMagician/coinbase-pro-sdk/Testing%20suite/master?label=tests) ![PHPStan level](https://img.shields.io/badge/phpstan-level%207-success) ![](https://img.shields.io/badge/coverage-88%25-green) ![Code Climate maintainability](https://img.shields.io/codeclimate/maintainability-percentage/MockingMagician/coinbase-pro-sdk?label=code%20climate) ![LICENSE BADGE](https://img.shields.io/packagist/l/mocking-magician/coinbase-pro-sdk?color=blue) ![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/mocking-magician/coinbase-pro-sdk) 

## Install the package

```shell
composer require mocking-magician/coinbase-pro-sdk
```
***Please take the time to read all the documentation carefully.***

## How do I access the features?

All the main and necessary functionalities to use this library are grouped in the [CoinbaseFacade class](./coinbase-facade.md).

## Versioning

Coinbase Pro SDK follow the [semver specification](https://semver.org/)

>Given a version number `MAJOR.MINOR.PATCH`, increment the:
>
>- `MAJOR` version when you make incompatible API changes
>- `MINOR` version when you add functionality in a backwards compatible manner
>- `PATCH` version when you make backwards compatible bug fixes.
>
>Additional labels for pre-release and build metadata are available as extensions to the MAJOR.MINOR.PATCH format.

Zero version, specific case (as 0.y.z) during initial development:
>Anything MAY change at any time. The public API SHOULD NOT be considered stable.
