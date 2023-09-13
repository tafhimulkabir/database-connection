<?php
/**
 * Base Connection Class
 *
 * This file contains the BaseConnection class, which implements the Singleton design pattern
 * to establish connections to a chosen database and cache.
 *
 * @version 0.1.0
 * @license Public Domain
 * @author Tafhimul Kabir <tafhimulkabir@protonmail.com>
 */

declare(strict_types=1);

namespace App\Connection;

// Ensure CONNECT_TO_DB_AND_CASH is defined, or return a 404 response and exit.
!defined('CONNECT_TO_DB_AND_CASH') && http_response_code(404) && exit;

/**
 * BaseConnection
 *
 * This class connects to the database and cache and utilizes the Singleton design pattern
 * to ensure only one instance is created, promoting global state sharing. It also employs
 * the Strategy design pattern to choose the database and cache based on the parameters
 * provided in the configuration file.
 */
final class BaseConnection
{
    private static ?BaseConnection $instance = null;
    private static array $mainConfig = [];

    /**
     * Private constructor to prevent external instantiation.
     *
     * @param array $config The configuration parameters.
     */
    private function __construct(array $config)
    {
        self::$mainConfig = $config;
    }

    /**
     * Get an instance of BaseConnection.
     *
     * @return self An instance of BaseConnection.
     */
    public static function getInstance(array $config): self
    {
        return self::$instance ?? self::$instance = new BaseConnection($config);
    }
}
