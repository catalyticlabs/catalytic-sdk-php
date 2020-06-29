<?php

namespace Catalytic\SDK\Exceptions;

/**
 * An exception to be thrown when a DataTable is not found
 */
class DataTableNotFoundException extends NotFoundException
{
    public function __construct($message, $previous = null)
    {
        parent::__construct($message, $previous);
    }
}
