<?php

/**
 * An Integration Configuration object
 */
class IntegrationConfiguration
{
    private $clientId;
    private $clientSecret;
    private $tokenPath;
    private $revokePath;
    private $site;
    private $authorizeBaseUrl;
    private $scopes;
    private $useBodyAuth;

    public function __construct(
        $clientId,
        $clientSecret,
        $tokenPath,
        $revokePath,
        $site,
        $authorizeBaseUrl,
        $scopes,
        $useBodyAuth
    ) {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->tokenPath = $tokenPath;
        $this->revokePath = $revokePath;
        $this->site = $site;
        $this->authorizeBaseUrl = $authorizeBaseUrl;
        $this->scopes = $scopes;
        $this->useBodyAuth = $useBodyAuth;
    }

    /**
     * Get the value of clientId
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Set the value of clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * Get the value of clientSecret
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * Set the value of clientSecret
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
    }
    /**
     * Get the value of tokenPath
     */
    public function getTokenPath()
    {
        return $this->tokenPath;
    }

    /**
     * Set the value of tokenPath
     */
    public function setTokenPath($tokenPath)
    {
        $this->tokenPath = $tokenPath;
    }
    /**
     * Get the value of revokePath
     */
    public function getRevokePath()
    {
        return $this->revokePath;
    }

    /**
     * Set the value of revokePath
     */
    public function setRevokePath($revokePath)
    {
        $this->revokePath = $revokePath;
    }
    /**
     * Get the value of site
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set the value of site
     */
    public function setSite($site)
    {
        $this->site = $site;
    }
    /**
     * Get the value of authorizeBaseUrl
     */
    public function getAuthorizeBaseUrl()
    {
        return $this->authorizeBaseUrl;
    }

    /**
     * Set the value of authorizeBaseUrl
     */
    public function setAuthorizeBaseUrl($authorizeBaseUrl)
    {
        $this->authorizeBaseUrl = $authorizeBaseUrl;
    }
    /**
     * Get the value of scopes
     */
    public function getScopes()
    {
        return $this->scopes;
    }

    /**
     * Set the value of scopes
     */
    public function setScopes($scopes)
    {
        $this->scopes = $scopes;
    }
    /**
     * Get the value of useBodyAuth
     */
    public function getUseBodyAuth()
    {
        return $this->useBodyAuth;
    }

    /**
     * Set the value of useBodyAuth
     */
    public function setUseBodyAuth($useBodyAuth)
    {
        $this->useBodyAuth = $useBodyAuth;
    }

}