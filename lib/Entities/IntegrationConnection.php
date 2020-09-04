<?php

namespace Catalytic\SDK\Entities;

/**
 * An Integration Connection object
 */

 class IntegrationConnection
 {
     private $id;
     private $name;
     private $referenceName;
     private $integrationId;

     public function __construct(
         $id = null,
         $name = null,
         $referenceName = null,
         $integrationId = null
    ) {
         $this->id = $id;
         $this->name = $name;
         $this->referenceName = $referenceName;
         $this->integrationId = $integrationId;
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
     * Get the value of referenceName
     */
    public function getReferenceName()
    {
        return $this->referenceName;
    }

    /**
     * Set the value of referenceName
     */
    public function setReferenceName($referenceName)
    {
        $this->referenceName = $referenceName;
    }

    /**
     * Get the value of integrationId
     */
    public function getIntegrationId()
    {
        return $this->integrationId;
    }

    /**
     * Set the value of integrationId
     */
    public function setIntegrationId($integrationId)
    {
        $this->integrationId = $integrationId;
    }
 }