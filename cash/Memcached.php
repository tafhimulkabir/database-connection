<?php
/**
 * Database Connection using MySQL
 */
declare(strict_types = 1);

namespace App\Database\Cash;

require_once BASE_URI . DIRECTORY_SEPARATOR . 'CacheStrategy.php';

class Memcached implements CacheStrategy
{
    private $host;
    private $port;

    public function __construct($cache_host, $cache_port)
    {
        $this->host = $cache_host;
        $this->port = $cache_port;
    }

    public function connect() {
        echo "Connecting to Memcached cache on '{$this->host}:{$this->port}'\n";
    }
}
