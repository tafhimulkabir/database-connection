<?php
/**
 * Database Connection using MySQL
 */
declare(strict_types = 1);

namespace App\Database\Connection;

require_once BASE_URI . DIRECTORY_SEPARATOR . 'DatabaseStrategy.php';

class MySQL implements DatabaseStrategy
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


    public function connect() {
        $this->conn = null;
  
        try { 
          $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
          echo 'Connection Error: ' . $e->getMessage();
        }
  
        return $this->conn;
      }
}
