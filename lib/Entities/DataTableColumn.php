<?php

namespace Catalytic\SDK\Entities;

class DataTableColumn
{
    private $name;
    private $type;
    private $referenceName;
    private $restrictions;

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
     * Get the value of type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     */
    public function setType($type)
    {
        $this->type = $type;
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
     * Get the value of restrictions
     */
    public function getRestrictions()
    {
        return $this->restrictions;
    }

    /**
     * Set the value of restrictions
     */
    public function setRestrictions($restrictions)
    {
        $this->restrictions = $restrictions;
    }
}