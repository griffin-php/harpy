# harpy

Search for Classes Names inside PHP Source Code

[![Build Status](https://github.com/griffin-php/harpy/actions/workflows/test.yml/badge.svg?branch=main)](https://github.com/griffin-php/harpy/actions/workflows/test.yml?query=branch%3Amain)
[![Latest Stable Version](https://poser.pugx.org/griffin/harpy/v/stable?format=flat)](https://packagist.org/packages/griffin/harpy)
[![Codecov](https://codecov.io/gh/griffin-php/harpy/branch/main/graph/badge.svg)](https://codecov.io/gh/griffin-php/harpy)
[![License](https://poser.pugx.org/griffin/harpy/license?format=flat)](https://packagist.org/packages/griffin/harpy)

## Description

Harpy is a micro library to search for classes names inside PHP source code,
using patterns to find files via patterns and parsing them to retrieve all
classes defined.

## Installation

This package uses [Composer](https://packagist.org/packages/griffin/harpy) as
default repository. You can install it adding the name of package in `require`
section of `composer.json`, pointing to the latest stable version.

```json
{
  "require": {
    "griffin/harpy": "^1.0"
  }
}
```

## Usage

The `Griffin\Harpy\Harpy::search` method use variadic parameters of `string`
representing files or directories. These directories will be recursively listed
searching for files. Each file found will be parsed searching for class
definitions.

```php
use Griffin\Harpy\Harpy;

$harpy = new Harpy();

$classnames = $harpy->search(
    // Files
    './src/Harpy.php',
    './tests/HarpyTest.php',
    // Directories
    './src',
    './tests',
);

var_dump($classnames);

/*
array(6) {
  [0]=>
  string(19) "Griffin\Harpy\Harpy"
  [1]=>
  string(27) "GriffinTest\Harpy\HarpyTest"
  [2]=>
  string(20) "Griffin\Harpy\Finder"
  [3]=>
  string(20) "Griffin\Harpy\Parser"
  [4]=>
  string(28) "GriffinTest\Harpy\FinderTest"
  [5]=>
  string(28) "GriffinTest\Harpy\ParserTest"
}
 */
```

If Harpy hasn't permissions to list directories or read files, warnings will not
be raised, because it only searches for classes and not handles errors. Also,
Harpy is not a class loader, you must use tools like Composer to execute this
job.

## Development

You can use Docker Compose to build an image and run a container to develop and
test this package.

```bash
docker-compose build
docker-compose run --rm php composer install
docker-compose run --rm php composer test
```

## References

* [nikic/PHP-Parser](https://github.com/nikic/PHP-Parser): A PHP parser written in PHP

## License

This package is opensource and available under MIT license described in
[LICENSE](https://github.com/griffin-php/harpy/blob/main/LICENSE).
