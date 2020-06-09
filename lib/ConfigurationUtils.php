<?php

namespace Catalytic\SDK;

/**
 * A wrapper around the Configuration class so that we only create a single
 *  configuration object and reuse it.
 */
class ConfigurationUtils
{
    private static Configuration $config;

    /**
     * Creates a Configuration if one doesn't exist and returns it
     *
     * @param string $secret    The secret to set on the configuration
     * @return Configuration    The Configuration object
     */
    public static function getConfiguration(string $secret): Configuration
    {
        // If a configuration object doesn't exist, create one
        if (!isset(self::$config)) {
            $version = self::getVersion();
            self::$config = Configuration::getDefaultConfiguration();
            self::$config->setUserAgent("Catalytic PHP SDK/$version");
            self::$config->setAccessToken(trim($secret));
        }

        return self::$config;
    }

    /**
     * Get the version from the .version file
     *
     * @return string   The version of the SDK
     */
    private static function getVersion(): string
    {
        $version = file_get_contents(__DIR__ . '/../.version');
        return $version;
    }
}