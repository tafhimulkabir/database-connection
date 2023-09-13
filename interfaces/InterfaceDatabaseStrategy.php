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
     * @param string $db_host       The database host.
     * @param int    $db_port       The database port.
     * @param string $db_user       The database username.
     * @param string|null $db_pass  The database password (optional, may be null).
     * @param string $db_name       The database name.
     *
     * @return PDO|null The PDO database connection or null on failure.
     */
    public function connect(string $db_host, int $db_port, string $db_user, ?string $db_pass, string $db_name) : PDO | null;
}
