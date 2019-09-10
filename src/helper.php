<?php declare(strict_types=1);

if (! function_exists('env')) {
    function env($name, $default = null)
    {
        return \Arcesilas\Env\Env::get($name, $default);
    }
}
