<?php

namespace Catalytic\SDK\Exceptions;

/**
 * An exception to be thrown when a User is not found
 */
class UserNotFoundException extends NotFoundException
{
    public function __construct($message, $previous = null)
    {
        parent::__construct($message, $previous);
    }
}
