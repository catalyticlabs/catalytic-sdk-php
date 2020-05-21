<?php

namespace Catalytic\SDK\Exceptions;

use Exception;

/**
 * An exception to be thrown when an Instance Step is not found
 */
class InstanceStepNotFoundException extends NotFoundException
{
    public function __construct($message, Exception $previous = null)
    {
        parent::__construct($message, $previous);
    }
}
