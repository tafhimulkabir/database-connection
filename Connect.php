<?php
/**
 * Database Connection using Singleton Design Pattern
 */
declare(strict_types = 1);

namespace App\Database;

const BASE_URI = __DIR__ . DIRECTORY_SEPARATOR;

require_once BASE_URI . 'database' . DIRECTORY_SEPARATOR . 'MySQL.php';
require_once BASE_URI . 'database' . DIRECTORY_SEPARATOR . 'PostgreSQL.php';
require_once BASE_URI . 'database' . DIRECTORY_SEPARATOR . 'SQLite.php';

require_once BASE_URI . 'cash' . DIRECTORY_SEPARATOR . 'Redis.php';
require_once BASE_URI . 'cash' . DIRECTORY_SEPARATOR . 'Memcached.php';

use App\Database\Connection\MySQL;
use App\Database\Connection\PostgreSQL;
use App\Database\Connection\SQLite;

use App\Database\Cash\Redis;
use App\Database\Cash\Memcached;

/**
 * Database Class
 */
final class Connect
{
    private static Connect $instance = null;
    private array $dbStrategies = [];
    private array $cashStrategies = [];

    private function __construct()
    {
        $config = parse_ini_file('config.ini', true);

        foreach ($config['databases'] as $db_name => $db_conf) {
            $db_type        = $db_conf['type'];
            $db_host        = $db_conf['host'];
            $db_port        = $db_conf['port'];
            $db_username    = $db_conf['username'];
            $db_password    = $db_conf['password'];
            $db_database    = $db_conf['database'];

            match ($db_type) {
                'mysql'         => $this->dbStrategies[$db_name] = new MySQL($db_host, $db_port, $db_username, $db_password, $db_database),
                'postgresql'    => $this->dbStrategies[$db_name] = new PostgreSQL($db_host, $db_port, $db_username, $db_password, $db_database),
                'sqlite'        => $this->dbStrategies[$db_name] = new SQLite($db_host, $db_port, $db_username, $db_password, $db_database),
                default         => 'Unsupported database type: ' . $db_type . '!'
            };
        }

        foreach ($config['caches'] as $cache_name => $cache_conf) {
            $cache_type         = $cache_conf['type'];
            $cache_host         = $cache_conf['host'];
            $cache_port         = $cache_conf['port'];
            $cache_password     = isset($cache_conf['password']) ? $cache_conf['password'] : null;
            $cache_database     = isset($cache_conf['database']) ? $cache_conf['database'] : null;


            match ($cache_type) {
                'redis'             => $this->cashStrategies[$cache_name] = new Redis($cache_host, $cache_port, $cache_password, $cache_database),
                'memcached'         => $this->cashStrategies[$cache_name] = new Memcached($cache_host, $cache_port),
                default         => 'Unsupported cash type: ' . $cache_type . '!'
            };
        }
    }

    public static function getInstance()
    {
        return self::$instance ?? self::$instance = new Database();
    }

    public function connect($database_name, $cache_name = null)
    {
        $this->dbStrategies[$database_name] ??= 'Unknown database: ' . $database_name . '!';
        $this->dbStrategies[$database_name]->connect();

        if ($cache_name !== null) {
            $this->cashStrategies[$cache_name] ??= 'Unknown cache: ' . $cache_name . '!';
            $this->cashStrategies[$cache_name]->connect();
        }
    }
}
