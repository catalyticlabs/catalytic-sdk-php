<?php

namespace Catalytic\SDK\Entities;

/**
 * A User object
 */
class User
{
    private $id;
    private $teamName;
    private $email;
    private $fullName;
    private $isTeamAdmin;
    private $isDeactivated;
    private $isLockedOut;
    private $createdDate;

    public function __construct(
        $id = null,
        $teamName = null,
        $email = null,
        $fullName = null,
        $isTeamAdmin = null,
        $isDeactivated = null,
        $isLockedOut = null,
        $createdDate = null
    ) {
        $this->id = $id;
        $this->teamName = $teamName;
        $this->email = $email;
        $this->fullName = $fullName;
        $this->isTeamAdmin = $isTeamAdmin;
        $this->isDeactivated = $isDeactivated;
        $this->isLockedOut = $isLockedOut;
        $this->createdDate = $createdDate;
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
     * Get the value of teamName
     */
    public function getTeamName()
    {
        return $this->teamName;
    }

    /**
     * Set the value of teamName
     */
    public function setTeamName($teamName)
    {
        $this->teamName = $teamName;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get the value of fullName
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set the value of fullName
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * Get the value of isTeamAdmin
     */
    public function getIsTeamAdmin()
    {
        return $this->isTeamAdmin;
    }

    /**
     * Set the value of isTeamAdmin
     */
    public function setIsTeamAdmin($isTeamAdmin)
    {
        $this->isTeamAdmin = $isTeamAdmin;
    }

    /**
     * Get the value of isDeactivated
     */
    public function getIsDeactivated()
    {
        return $this->isDeactivated;
    }

    /**
     * Set the value of isDeactivated
     */
    public function setIsDeactivated($isDeactivated)
    {
        $this->isDeactivated = $isDeactivated;
    }

    /**
     * Get the value of isLockedOut
     */
    public function getIsLockedOut()
    {
        return $this->isLockedOut;
    }

    /**
     * Set the value of isLockedOut
     */
    public function setIsLockedOut($isLockedOut)
    {
        $this->isLockedOut = $isLockedOut;
    }

    /**
     * Get the value of createdDate
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set the value of createdDate
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }
}