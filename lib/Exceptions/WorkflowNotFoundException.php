<?php

namespace Catalytic\SDK\Exceptions;

/**
 * An exception to be thrown when a Workflow is not found
 */
class WorkflowNotFoundException extends NotFoundException
{
    public function __construct($message, $previous = null)
    {
        parent::__construct($message, $previous);
    }
}
