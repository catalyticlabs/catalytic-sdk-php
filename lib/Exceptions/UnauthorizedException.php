<?php

namespace Catalytic\SDK\Exceptions;

use Exception;

/**
 * A exception to be thrown when trying to perform an action that a user is unauthorized to do
 */
class UnauthorizedException extends Exception
{
    public function __construct($message, $previous = null)
    {
        if (!$message) {
            $message = 'Unauthorized';
        }

        parent::__construct($message, 0, $previous);
    }
}
