<?php
/**
 * Database Connection using MySQL
 */
declare(strict_types = 1);

namespace App\Interfaces;

interface InterfaceCacheStrategy {
    public function connect();
}
