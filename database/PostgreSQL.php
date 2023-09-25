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
     * Establishes a PostgreSQL database connection.
     *
     * @param array $db_data Hold all the information need to connect to database.
     *
     * @return PDO|null The PDO database connection or null on failure.
     */
    public function connect(array $db_data) : PDO | null
    {
        $this->connect = null;

        $db_host = $db_data['host'];
        $db_port = $db_data['port'];
        $db_name = $db_data['name'];
        $db_user = $db_data['user'];
        $db_pass = $db_data['pass'];

        try {
            // Create a PDO database connection for PostgreSQL
            $this->connect = new PDO("pgsql:host=$db_host;port=$db_port;dbname=$db_name;user=$db_user;password=$db_pass");
            
            // Set PDO error mode to exceptions
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage(); // Handle connection error
        }

        return $this->connect;
    }
}
