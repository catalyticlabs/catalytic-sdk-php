<?php

namespace Catalytic\SDK\Exceptions;

/**
 * An exception to be thrown when an IntegrationConnection is not found
 */
class IntegrationConnectionNotFoundException extends NotFoundException
{
    public function __construct($message, $previous = null)
    {
        parent::__construct($message, $previous);
    }
}
