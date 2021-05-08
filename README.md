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
