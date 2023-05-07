<?php
/**
 * Database Connection using MySQL
 */
declare(strict_types = 1);

namespace App\Database\Cash;

require_once BASE_URI . DIRECTORY_SEPARATOR . 'CacheStrategy.php';

class Redis implements CacheStrategy
{
    private $host;
    private $port;
    private $password;
    private $database;

    public function __construct($cache_host, $cache_port, $cache_password, $cache_database)
    {
        $this->host = $cache_host;
        $this->port = $cache_port;
        $this->password = $cache_password;
        $this->database = $cache_database;
    }

    public function connect() {
        echo "Connecting to Redis cache on '{$this->host}:{$this->port}' with password '{$this->password}' and database '{$this->database}'\n";
    }
}
