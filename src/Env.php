<?php

namespace Arcesilas\Env;

class Env
{
    protected static $values = [
        'true'  => true,
        'on'    => true,
        'yes'   => true,
        'false' => false,
        'off'   => false,
        'no'    => false,
        'null'  => null,
    ];

    /**
     * Returns the environment variable or default value
     * @param  string $name
     * @param  mixed $default
     * @return mixed
     */
    public static function get(string $name, $default = null)
    {
        return static::handleValue(getenv($name, false), $default);
    }

    public static function getLocal(string $name, $default = null)
    {
        return static::handleValue(getenv($name, true), $default);
    }

    protected static function handleValue($value, $default)
    {
        if (false === $value) {
            return $default instanceof \Closure ? $default() : $default;
        }

        return static::convert($value);
    }

    protected static function convert($value)
    {
        if (ctype_digit($value)) {
            return (int) $value;
        }

        if (preg_match('`[0-9]*\.[0-9]+`', $value)) {
            return (float) $value;
        }

        $lowerValue = strtolower($value);

        return array_key_exists($lowerValue, static::$values)
            ? static::$values[$lowerValue]
            : trim($value, '"\'');
    }
}
