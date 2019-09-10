<?php

namespace Arcesilas\Env;

class Env
{
    /**
     * Set to true to only return local environment variables (set by the operating system or putenv).
     * @see https://www.php.net/manual/en/function.getenv.php#refsect1-function.getenv-parameters
     * @var bool
     */
    protected static $localOnly = false;

    /**
     * Set the value of the second argument passed to getenv() function
     * @param  bool   $localOnly
     * @return void
     */
    public static function localOnly(bool $localOnly = false): void
    {
        static::$localOnly = $localOnly;
    }

    /**
     * Returns the environment variable or default value
     * @param  string $name
     * @param  mixed $default
     * @return mixed
     */
    public static function get(string $name, $default = null)
    {
        $value = getenv($name, static::$localOnly);

        if (false === $value) {
            return $default instanceof \Closure ? $default() : $default;
        }

        if (ctype_digit($value)) {
            return (int) $value;
        }

        if (preg_match('`[0-9]*\.[0-9]+`', $value)) {
            return (float) $value;
        }

        switch (strtolower($value)) {
            case 'true':
            case 'on':
            case 'yes':
                return true;
            case 'false':
            case 'off':
            case 'no':
                return false;
            case 'null':
                return null;
        }

        return trim($value, '"\'');
    }
}
