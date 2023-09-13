<?php
/**
 * Enum Database Connection
 *
 * This enum check database type and  return enum type for it.
 *
 * @version 0.1.0
 * @license Public Domain
 * @package App\Database
 */

declare(strict_types = 1);

namespace App\Enum;

enum EnumDatabase
{
    case MySQL;
    case PostgreSQL;
    case SqLite;

    public static function setDb(string $database_type) : self | string
    {
        $database_type = strtolower(trim(htmlspecialchars($database_type)));

        return match($database_type) {
            'mysql'         => self::MySQL,
            'postgresql'    => self::PostgreSQL,
            'sqlite'        => self::SqLite,
            default         => 'Unsupported database type: ' . $database_type . '!'
        };
    }
}
