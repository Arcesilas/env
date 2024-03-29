[![Scrutinizer build][ico-build]][link-scrutinizer]
[![Scrutinizer coverage][ico-coverage]][link-scrutinizer]
[![Scrutinizer code quality][ico-quality]][link-scrutinizer]
[![PHP version][ico-php]][link-packagist]
[![Packagist Version][ico-version]][link-packagist]
[![License][ico-license]](LICENSE.md)
![Maintenance][ico-maintenance]

# Env

This simple package helps you get environment variables with getenv.

## Installation

`composer require arcesilas/env`

## Usage

```php
use Arcesilas\Env\Env;

$debug = Env::get('DEBUG');
$dsn = Env::get('DSN', 'sqlite:memory:'); // Returns the DSN env value, "sqlite:memory:" if not set
```

You may prefer to use the function helper:

```php
$debug = env('DEBUG');
$dsn = env('DSN', 'sqlite:memory:');
```

## Default values

When an environment variable is not set, `null` is returned by default. You can specify a default value as the second argument.

The default value may be a Closure:

```php
$foo = env('foo', function () {
    return 42;
});
```

The Closure will be executed and its result will be returned.

## Types conversion

Some values are automatically converted to their native PHP equivalent type:

- integers
- floats
- booleans
- null

Booleans can be converted from the following (case insensitive) strings:
- `"true"`, `"on"`, `"yes"` => `true`
- `"false"`, `"off"`, `"no"` => `false`

[ico-build]: https://img.shields.io/scrutinizer/build/g/Arcesilas/env?style=flat-square
[ico-coverage]: https://img.shields.io/scrutinizer/coverage/g/Arcesilas/env?style=flat-square
[ico-quality]: https://img.shields.io/scrutinizer/quality/g/Arcesilas/env?style=flat-square
[ico-php]: https://img.shields.io/packagist/php-v/Arcesilas/env?style=flat-square
[ico-version]: https://img.shields.io/packagist/v/Arcesilas/env?style=flat-square
[ico-license]: https://img.shields.io/github/license/Arcesilas/env?style=flat-square
[ico-maintenance]: https://img.shields.io/maintenance/yes/2019?style=flat-square

[link-scrutinizer]: https://scrutinizer-ci.com/g/Arcesilas/env/
[link-packagist]: https://packagist.org/packages/arcesilas/env
