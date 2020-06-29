<?php

namespace Catalytic\SDK\Exceptions;

/**
 * An exception to be thrown when an Instance Step is not found
 */
class InstanceStepNotFoundException extends NotFoundException
{
    public function __construct($message, $previous = null)
    {
        parent::__construct($message, $previous);
    }
}
