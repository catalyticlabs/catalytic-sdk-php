<?php

namespace Catalytic\SDK\Exceptions;

/**
 * An exception to be thrown when an Instance is not found
 */
class InstanceNotFoundException extends NotFoundException
{
    public function __construct($message, $previous = null)
    {
        parent::__construct($message, $previous);
    }
}
