<?php

namespace Catalytic\SDK\Entities;

/**
 * A File object
 */
class File
{
    private string $id;
    private string $name;
    private string $teamName;
    private string $contentType;
    private int $sizeInBytes;
    private string $displaySize;
    private bool $isPublic;
    private string $md5Hash;
    private string $referenceName;

    public function __construct(
        $id = null,
        $name = null,
        $teamName = null,
        $contentType = null,
        $sizeInBytes = null,
        $displaySize = null,
        $isPublic = null,
        $md5Hash = null,
        $referenceName = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->teamName = $teamName;
        $this->contentType = $contentType;
        $this->sizeInBytes = $sizeInBytes;
        $this->displaySize = $displaySize;
        $this->isPublic = $isPublic;
        $this->md5Hash = $md5Hash;
        $this->referenceName = $referenceName;
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
     * Get the value of contentType
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * Set the value of contentType
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
    }

    /**
     * Get the value of sizeInBytes
     */
    public function getSizeInBytes()
    {
        return $this->sizeInBytes;
    }

    /**
     * Set the value of sizeInBytes
     */
    public function setSizeInBytes($sizeInBytes)
    {
        $this->sizeInBytes = $sizeInBytes;
    }

    /**
     * Get the value of displaySize
     */
    public function getDisplaySize()
    {
        return $this->displaySize;
    }

    /**
     * Set the value of displaySize
     */
    public function setDisplaySize($displaySize)
    {
        $this->displaySize = $displaySize;
    }

    /**
     * Get the value of isPublic
     */
    public function getIsPublic()
    {
        return $this->isPublic;
    }

    /**
     * Set the value of isPublic
     */
    public function setIsPublic($isPublic)
    {
        $this->isPublic = $isPublic;
    }

    /**
     * Get the value of md5Hash
     */
    public function getMd5Hash()
    {
        return $this->md5Hash;
    }

    /**
     * Set the value of md5Hash
     */
    public function setMd5Hash($md5Hash)
    {
        $this->md5Hash = $md5Hash;
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
}