<?php

namespace Catalytic\SDK\Exceptions;

use Exception;

/**
 * An exception to be used when something unexpected happens
 */
class InternalErrorException extends Exception
{
    public function __construct($message, Exception $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}