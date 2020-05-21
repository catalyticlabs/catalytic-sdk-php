<?php

namespace Catalytic\SDK\Entities;

/**
 * An object which represents a page of dataTables
 */
class DataTablesPage
{
    private array $dataTables;
    private ?string $nextPageToken;
    private string $count;

    public function __construct($dataTables, $count, $nextPageToken = null)
    {
        $this->dataTables = $dataTables;
        $this->nextPageToken = $nextPageToken;
        $this->count = $count;
    }

    /**
     * Get the value of dataTables
     */
    public function getDataTables()
    {
        return $this->dataTables;
    }

    /**
     * Set the value of dataTables
     */
    public function setDataTables($dataTables)
    {
        $this->dataTables = $dataTables;
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
