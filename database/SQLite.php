<?php
/**
 * SQLite Database Connection Class
 *
 * This class provides an SQLite database connection implementation
 * that adheres to the InterfaceDatabaseStrategy interface.
 *
 * @version 0.1.0
 * @license Public Domain
 * @package App\Database
 */

declare(strict_types = 1);

namespace App\Database;

// Include the necessary interface
require_once BASE_URI . DIRECTORY_SEPARATOR . 'DatabaseStrategy.php';

use PDO;
use PDOException;
use App\Interfaces\InterfaceDatabaseStrategy;

class SQLite implements InterfaceDatabaseStrategy
{
    private PDO $connect;

    /**
     * Establishes an SQLite database connection.
     *
     * @param string $db_host     The SQLite database file path.
     * @param int    $db_port     Not used for SQLite (can be set to 0).
     * @param string $db_user     Not used for SQLite (can be an empty string).
     * @param string $db_pass     Not used for SQLite (can be an empty string).
     * @param string $db_name     Not used for SQLite (can be an empty string).
     *
     * @return PDO|null The PDO database connection or null on failure.
     */
    public function connect(string $db_host, int $db_port, string $db_user, string | null $db_pass, string $db_name) : PDO | null
    {
        $this->connect = null;

        try {
            // Create a PDO database connection for SQLite
            $this->connect = new PDO("sqlite:$db_host");

            // Set PDO error mode to exceptions
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage(); // Handle connection error
        }

        return $this->connect;
    }
}
