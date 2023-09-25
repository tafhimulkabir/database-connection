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

use PDO;
use App\Enum\EnumDatabase;

const BASE_URI = __DIR__ . DIRECTORY_SEPARATOR;

require_once BASE_URI . 'Enum' . DIRECTORY_SEPARATOR . 'EnumDatabase.php';

require_once BASE_URI . 'Database' . DIRECTORY_SEPARATOR . 'MySQL.php';
require_once BASE_URI . 'Database' . DIRECTORY_SEPARATOR . 'PostgreSQL.php';
require_once BASE_URI . 'Database' . DIRECTORY_SEPARATOR . 'SQLite.php';

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
    private static null | BaseConnection $instance = null;
    private static array $mainConfig = [];
    private PDO $dbConnection;

    /**
     * Private constructor to prevent external instantiation.
     *
     * @param array $config The configuration parameters.
     */
    private function __construct(array $config)
    {
        self::$mainConfig = $config;

        $this->dbConnection = $this->setDatabaseType(EnumDatabase::setDb('mysql'));
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

    private function setDatabaseType(string $database_type) : PDO | string
    {
        return match($database_type) {
            EnumDatabase::MySQL         => new \App\Database\MySQL(),
            EnumDatabase::PostgreSQL    => new \App\Database\PostgreSQL(),
            EnumDatabase::SqLite        => new \App\Database\SqLite(),
            default         => 'Unsupported database type: ' . $database_type . '!'
        };
    }

    /**
     * Database Connection
     *
     * @return PDO
     */
    public function connect() : PDO
    {
        return $this->dbConnection;
    }

}
