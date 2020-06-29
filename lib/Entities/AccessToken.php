<?php

namespace Catalytic\SDK\Entities;

/**
 * A AccessToken object
 */
class AccessToken
{
    private $id;
    private $domain;
    private $name;
    private $type;
    private $token;
    private $secret;
    private $environment;
    private $owner;

    public function __construct(
        $id = null,
        $domain = null,
        $name = null,
        $type = null,
        $token = null,
        $secret = null,
        $environment = null,
        $owner = null
    ) {
        $this->id = $id;
        $this->domain = $domain;
        $this->name = $name;
        $this->type = $type;
        $this->token = $token;
        $this->secret = $secret;
        $this->environment = $environment;
        $this->owner = $owner;
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
     * Get the value of domain
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set the value of domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
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
     * Get the value of token
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * Get the value of secret
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * Set the value of secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    /**
     * Get the value of environment
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * Set the value of environment
     */
    public function setEnvironment($environment)
    {
        $this->environment = $environment;
    }

    /**
     * Get the value of owner
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set the value of owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }
}