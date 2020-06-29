<?php

namespace Catalytic\SDK\Exceptions;

/**
 * An exception to be thrown when an Acess Token is not found
 */
class AccessTokenNotFoundException extends NotFoundException
{
    public function __construct($message, $previous = null)
    {
        parent::__construct($message, $previous);
    }
}
