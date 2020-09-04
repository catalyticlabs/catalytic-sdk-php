<?php

namespace Catalytic\SDK;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Catalytic logger
 */
class CatalyticLogger
{
    public static function getLogger($clazz)
    {
        $logLevel = getenv('CATALYTIC_LOG_LEVEL');

        if ($logLevel === 'DEBUG') {
            $logger = new Logger($clazz);
            $logger->pushHandler(new StreamHandler('php://stdout', Logger::DEBUG));
            return $logger;
        }

        return new Logger($clazz);
    }
}