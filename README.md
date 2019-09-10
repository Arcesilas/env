# Env

This simple package helps you get environment variables with getenv.

## Installation

`composer require arcesilas\env`

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
