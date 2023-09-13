<?php
/**
 * Database Connection using MySQL
 */
declare(strict_types = 1);

namespace App\Database\Connection;

interface DatabaseStrategy {
    public function connect();
}
