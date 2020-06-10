<?php

namespace Catalytic\SDK;

use Monolog\Logger;

/**
 * Catalytic logger
 */
class CatalyticLogger
{
    public static function getLogger(string $clazz): Logger
    {
        return new Logger($clazz);
    }
}