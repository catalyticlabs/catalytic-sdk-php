<?php

namespace Catalytic\SDK\Exceptions;

/**
 * An exception to be thrown when a File is not found
 */
class FileNotFoundException extends NotFoundException
{
    public function __construct($message, $previous = null)
    {
        parent::__construct($message, $previous);
    }
}
