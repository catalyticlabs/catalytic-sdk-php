<?php

namespace Catalytic\SDK\Exceptions;

use Exception;

/**
 * An exception to be thrown when a DataTable is not found
 */
class DataTableNotFoundException extends NotFoundException
{
    public function __construct($message, Exception $previous = null)
    {
        parent::__construct($message, $previous);
    }
}
