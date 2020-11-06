<?php

if ($_SERVER['SERVER_NAME'] == "localhost") {
    Dotenv\Dotenv::createImmutable(__DIR__ . '/../')->load();
}

return
[
    'paths' => [
        'migrations' => dirname(__DIR__, 1) . '/database/migrations',
        'seeds' => dirname(__DIR__, 1) . '/database/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'dev',
        'prod' => [
            'adapter' => 'sqlite', // mysql | pgsql | sqlsrv
            // 'host' => 'localhost',
            'name' => dirname(__DIR__, 1) . '/database/sqlite',
            // 'user' => 'root',
            // 'pass' => '',
            // 'port' => '3306',
            // 'charset' => 'utf8',
        ],
        'dev' => [
            'adapter' => 'sqlite', // mysql | pgsql | sqlsrv
            // 'host' => 'localhost',
            'name' => dirname(__DIR__, 1) . '/database/sqlite',
            // 'user' => 'root',
            // 'pass' => '',
            // 'port' => '3306',
            // 'charset' => 'utf8',
        ],
        'test' => [
            'adapter' => 'sqlite', // mysql | pgsql | sqlsrv
            // 'host' => 'localhost',
            'name' => dirname(__DIR__, 1) . '/database/sqlite',
            // 'user' => 'root',
            // 'pass' => '',
            // 'port' => '3306',
            // 'charset' => 'utf8',
        ]
    ],
    'version_order' => 'creation'
];
