<?php
/**
 * Database Connection using MySQL
 */
declare(strict_types = 1);

namespace App\Database\Connection;

class SQLite implements DatabaseStrategy
{
    private $host;
    private $port;
    private $username;
    private $password;
    private $database;

    public function __construct($db_host, $db_port, $db_username, $db_password, $db_database)
    {
        $this->host         = $db_host;
        $this->port         = $db_port;
        $this->username     = $db_username;
        $this->password     = $db_password;
        $this->database     = $db_database;
    }

    public function connect()
    {
        echo "Connecting to SQLite database '{$this->database}' on '{$this->host}:{$this->port}' with username '{$this->username}'\n";
    }
}
