<?php

namespace Catalytic\SDK\Exceptions;

use Exception;

/**
 * An exception to be thrown when an Acess Token is not found
 */
class AccessTokenNotFoundException extends NotFoundException
{
    public function __construct($message, Exception $previous = null)
    {
        parent::__construct($message, $previous);
    }
}
