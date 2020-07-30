<?php

namespace Catalytic\SDK;

/**
 * A wrapper around the Configuration class so that we only create a single
 *  configuration object and reuse it.
 */
class ConfigurationUtils
{
    /**
     * Creates a Configuration if one doesn't exist and returns it
     *
     * @param string $secret    The secret to set on the configuration
     * @return Configuration    The Configuration object
     */
    public static function getConfiguration($secret)
    {
        $version = self::getVersion();
        $config = Configuration::getDefaultConfiguration();
        $config->setUserAgent("catalytic-sdk-php/$version");
        $config->setAccessToken(trim($secret));

        return $config;
    }

    /**
     * Get the version from the .version file
     *
     * @return string   The version of the SDK
     */
    private static function getVersion()
    {
        $version = file_get_contents(__DIR__ . '/../.version');
        return $version;
    }
}