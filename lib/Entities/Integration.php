<?php

namespace Catalytic\SDK\Entities;

/**
 * An Integration object
 */
class Integration
{
    private $id;
    private $name;
    private $isCustomIntegration;
    private $connections;
    private $connectionParams;

    public function __construct(
        $id = null,
        $name = null,
        $isCustomIntegration = null,
        $connections = null,
        $connectionParams = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->isCustomIntegration = $isCustomIntegration;
        $this->connections = $connections;
        $this->connectionParams = $connectionParams;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get the value of isCustomIntegration
     */
    public function getIsCustomIntegration()
    {
        return $this->isCustomIntegration;
    }

    /**
     * Set the value of isCustomIntegration
     */
    public function setIsCustomIntegration($isCustomIntegration)
    {
        $this->isCustomIntegration = $isCustomIntegration;
    }

    /**
     * Get the value of connections
     */
    public function getConnections()
    {
        return $this->connections;
    }

    /**
     * Set the value of connections
     */
    public function setConnections($connections)
    {
        $this->connections = $connections;
    }

    /**
     * Get the value of connectionParams
     */
    public function getConnectionParams()
    {
        return $this->connectionParams;
    }

    /**
     * Set the value of connectionParams
     */
    public function setConnectionParams($connectionParams)
    {
        $this->connectionParams = $connectionParams;
    }
}