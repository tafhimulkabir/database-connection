<?php
/**
 * Database Connection using MySQL
 */
declare(strict_types = 1);

namespace App\Database\Cash;

interface CacheStrategy {
    public function connect();
}