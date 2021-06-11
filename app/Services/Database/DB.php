<?php
namespace App\Services\Database;

use Cake\Database\Connection;
use Cake\Database\Driver\Mysql;
use Cake\Database\Driver\Postgres;
use Cake\Database\Driver\Sqlite;
use Cake\Database\Driver\Sqlserver;

class DB
{
    /** @var Connection $connection */
    private static $connection;

    /**
     * @return Connection
     */
    public static function instance(): Connection
    {
        if (empty(self::$connection)) {
            $database            = require dirname(__DIR__, 2) . '/config/database.php';
            $default_environment = $database['environments']['default_environment'];
            $env                 = $database['environments'][$default_environment];

            $config = [
                'host'     => $env['host'] ?? null,
                'username' => $env['user'] ?? null,
                'password' => $env['pass'] ?? null,
                'database' => $env['name'] ?? null,
                'port'     => $env['port'] ?? null,
                'encoding' => $env['charset'] ?? null,
            ];

            switch ($env['adapter']) {
                case 'mysql':
                    $driver           = new Mysql($config);
                    $connectionConfig = ['driver' => $driver];

                    break;
                case 'pgsql':
                    $driver           = new Postgres($config);
                    $connectionConfig = ['driver' => $driver];

                    break;
                case 'sqlsrv':
                    $driver           = new Sqlserver($config);
                    $connectionConfig = ['driver' => $driver];

                    break;
                default:
                    $connectionConfig = [
                        'driver' => Sqlite::class,
                        'database' => $env['name'] . '.sqlite3'
                    ];

                    break;
            }

            self::$connection = new Connection($connectionConfig);
        }

        return self::$connection;
    }

    private function __construct()
    {}

    private function __clone()
    {}
}
