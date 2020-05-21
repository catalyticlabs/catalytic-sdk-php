<?php

namespace Catalytic\SDK\Exceptions;

use Exception;

/**
 * A generic exception that specific not found exceptions can extend
 */
class NotFoundException extends Exception
{
    public function __construct($message, Exception $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}
