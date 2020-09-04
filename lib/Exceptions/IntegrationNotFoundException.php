<?php

namespace Catalytic\SDK\Exceptions;

/**
 * An exception to be thrown when an Integration is not found
 */
class IntegrationNotFoundException extends NotFoundException
{
    public function __construct($message, $previous = null)
    {
        parent::__construct($message, $previous);
    }
}
