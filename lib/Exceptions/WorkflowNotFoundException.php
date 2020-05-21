<?php

namespace Catalytic\SDK\Exceptions;

use Exception;

/**
 * An exception to be thrown when a Workflow is not found
 */
class WorkflowNotFoundException extends NotFoundException
{
    public function __construct($message, Exception $previous = null)
    {
        parent::__construct($message, $previous);
    }
}
