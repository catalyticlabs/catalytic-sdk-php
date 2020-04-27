<?php

namespace Catalytic\SDK\Entities;

/**
 * An object which represents a page of files
 */
class FilesPage
{
    private array $files;
    private ?string $nextPageToken;
    private string $count;

    public function __construct($files, $count, $nextPageToken = null)
    {
        $this->files = $files;
        $this->nextPageToken = $nextPageToken;
        $this->count = $count;
    }

    /**
     * Get the value of files
     */
    public function getfiles()
    {
        return $this->files;
    }

    /**
     * Set the value of files
     */
    public function setfiles($files)
    {
        $this->files = $files;
    }

    /**
     * Get the value of nextPageToken
     */
    public function getNextPageToken()
    {
        return $this->nextPageToken;
    }

    /**
     * Set the value of nextPageToken
     */
    public function setNextPageToken($nextPageToken)
    {
        $this->nextPageToken = $nextPageToken;
    }

    /**
     * Get the value of count
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set the value of count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }
}
