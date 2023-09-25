<?php
/**
 * Database Connection Strategy Interface
 *
 * This interface defines the contract for implementing database connection strategies.
 *
 * @version 1.0.0
 * @license Public Domain
 * @package App\Interfaces
 */

declare(strict_types=1);

namespace App\Interfaces;

use PDO;
use PDOException;

/**
 * InterfaceDatabaseStrategy
 *
 * This interface defines the methods required for implementing a database connection strategy.
 */
interface InterfaceDatabaseStrategy
{
    /**
     * Establishes a database connection.
     *
     * @param array $db_data Hold all the information need to connect to database.
     *
     * @return PDO|null The PDO database connection or null on failure.
     */
    public function connect(array $db_data) : PDO | null;
}
