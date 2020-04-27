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
    public static function getConfiguration(string $secret) : Configuration
    {
        // If a configuration object doesn't exist, create one
        if (!isset(self::$config)) {
            self::$config = Configuration::getDefaultConfiguration();
            // TODO: Figure out how to dynamically set this
            self::$config->setUserAgent('Catalytic PHP SDK/0.2.0');
            self::$config->setAccessToken(trim($secret));
        }

        return self::$config;
    }
}