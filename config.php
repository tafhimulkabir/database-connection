<?php

return [
    'db_type'       => 'PostgreSQL',
    'db_host'       => 'localhost',
    'db_name'       => 'test_database',
    'db_user'       => 'root',
    'db_pass'       => '',
    'db_port'       => 5432,
    'db_prefix'     => 'app',
    'db_charset'    => 'utf8',
    'db_collation'  => 'utf8_unicode_ci',
    'db_retry'      => 5000,
    
    'cache'         => true,
    'cache_type'    => 'Redis',
    'cache_host'    => 'localhost',
    'cache_port'    => 6379,
    'cache_password'=> 'redis_password',
    
    'log_queries'   => true,
    'debug'         => true,
    'error_reporting' => E_ALL
];
