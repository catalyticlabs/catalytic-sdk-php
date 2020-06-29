<?php

namespace Catalytic\SDK;

use Monolog\Logger;

/**
 * Catalytic logger
 */
class CatalyticLogger
{
    public static function getLogger($clazz)
    {
        return new Logger($clazz);
    }
}