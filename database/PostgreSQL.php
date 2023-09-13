<?php
/**
 * PostgreSQL Database Connection Class
 *
 * This class provides a PostgreSQL database connection implementation
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

class PostgreSQL implements InterfaceDatabaseStrategy
{
    private PDO $connect;

    /**
     * Establishes a database connection.
     *
     * @param string $db_host     The database host.
     * @param int    $db_port     The database port.
     * @param string $db_user     The database username.
     * @param string $db_pass     The database password.
     * @param string $db_name     The database name.
     *
     * @return PDO|null The PDO database connection or null on failure.
     */
    public function connect(string $db_host, int $db_port, string $db_user, string | null $db_pass, string $db_name) : PDO | null
    {
        $this->connect = null;

        try {
            
            $this->connect = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name, $db_user, $db_pass); // Create a PDO database connection
            
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set PDO error mode to exceptions

        } catch (PDOException $e) {

            echo 'Connection Error: ' . $e->getMessage(); // Handle connection error

        }

        return $this->connect;
    }
}
